import React, {Component} from 'react';
import { Row, Col, Image, Form, Media, Accordion, Card, Button } from "react-bootstrap";
import "./VideoPlayer.css";
import { Link } from "react-router-dom";
import ReactJWPlayer from 'react-jw-player';
import ContentLoader from "../../components/Static/contentLoader";
import Helper from "../../components/Helper/helper";
import api from "../../Environment";
import io from "socket.io-client";
import { apiConstants } from "../../components/Constant/constants";
import LinearProgress from "@material-ui/core/LinearProgress";
import ToastDemo from "../Helper/toaster";
import configuration from "react-global-configuration";

const socket = apiConstants.socketUrl ? io(apiConstants.socketUrl) : "";
let userId = localStorage.getItem("userId");
let accessToken = localStorage.getItem("accessToken");
const $ = window.$;

class VideoPLayerIndex extends Helper {

    state = {
        loadingFirst: true,
        videoDetailsFirst: null,
        onPlayStarted: false,
        videoList: {},
        videoData: null,
        videoId: 0,
        socket: false,
        query: "",
        onSeekPlay: true,
        socketConnection: true,
        videoDuration: 0,
        socketConnected: false,
        videoPlayerInfo:null,
        loadingPlayerInfo:true,
        currentDuration:0,
        playbackSpeed:'1x',
        currentVolume:50,
        playButtonClicked: false,
        inputData: {},
    };
    
    componentDidMount() {
        if (this.props.location.state) {
            
            this.setState({ videoDetailsFirst: this.props.location.state.videoDetailsFirst });
            let inputData = {
                admin_video_id: this.props.location.state.videoDetailsFirst
                  .admin_video_id,
            };

            api
            .postMethod("video_player_info", inputData)
            .then((response) => {
                if (response.data.success === true) {
                    let videoPlayerInfo = response.data.data;
                    this.setState({
                        loadingPlayerInfo: false,
                        videoPlayerInfo: videoPlayerInfo,
                    });
                } else {
                    this.setState({ videoPlayerInfo: response.data });
                }
            })
            .catch(function(error) {});
            
            this.setState({ loadingFirst: false });
        } else {
          window.location = "/home";
        }
    }
    
    timer = async () => {
        if (this.state.onPlayStarted) {
          await this.socketConnectionfun(userId, accessToken);
        }
    };
    
    componentWillUnmount() {
        // use intervalId from the state to clear the interval
        clearInterval(this.state.intervalId);
    }

    onCompleteVideo = () => {
        this.addHistory(this.state.videoDetailsFirst.admin_video_id);
        this.setState({ onPlayStarted: false, socketConnection: false });
        if (this.state.socketConnected) {
            socket.emit("disconnect");
        }
    };
    
    onVideoPlay = async () => {

        let intervalId = setInterval(this.timer, 3000);
    
        this.setState({ intervalId: intervalId });
    
        this.setState({ onPlayStarted: true, socketConnection: true });
    
        let inputData = {
          admin_video_id: this.state.videoDetailsFirst
            .admin_video_id,
        };
        await this.onlySingleVideoFirst(inputData);
        this.redirectStatus(this.state.videoDetailsFirst);
    
        const seekTime = this.state.videoDetailsFirst.seek_time_in_seconds
          ? this.state.videoDetailsFirst.seek_time_in_seconds
          : 0;
        
        if (this.state.onSeekPlay) {
            const player = window.jwplayer('my-unique-id');
            player.seek(parseFloat(seekTime));
        }
    
        this.setState({ onSeekPlay: false });

        if(this.state.videoDetailsFirst.skip_intro_seconds > this.state.currentDuration) {
            $('#skip-intro-sec').hide();
        }
        
    };
    
    addHistory = (admin_video_id) => {
        api
        .postMethod("addHistory", { admin_video_id: admin_video_id })
        .then((response) => {
            if (response.data.success === true) {
            } else {
            }
        })
        .catch(function(error) {});
    };
    

    ref = (player) => {
        this.player = player;
    };

    socketConnectionfun = (userId, accessToken) => {
        if (apiConstants.socketUrl) {
            let videoId = this.state.videoDetailsFirst.admin_video_id;
        
            socket.on("connect", function() {
            let query = `user_id=` + userId + `&video_id=` + videoId;
        });
    
        socket.on("connected", function() {
            console.log("Connected");
            this.setState({ socketConnected: true });
        });
    
        socket.on("disconnect", function() {
            console.log("disconnect");
            this.setState({ socketConnected: false });
        });
    
        let videoData = [
            {
            sub_profile_id: localStorage.getItem("active_profile_id"),
            admin_video_id: videoId,
            id: userId,
            token: accessToken,
            duration: this.state.currentDuration,
            },
        ];
    
        socket.emit("save_continue_watching_video", videoData[0]);
        }
    };

    onPauseVideo = async () => {
        console.log("onPause");
        if (this.state.socketConnected) {
          socket.emit("disconnect");
        }
        clearInterval(this.state.intervalId);
    };
    
    onVideoTimeUpdate = (duration) => {
        let video_duration = duration.target.currentTime;

        let sec = parseInt(video_duration % 60);
        let min = parseInt((video_duration / 60) % 60);
        let hours = parseInt(video_duration / 3600);

        if (hours > 1) {
            this.setState({ videoDuration: hours + ":" + min + ":" + sec });
        } else {
            this.setState({ videoDuration: min + ":" + sec });
        }
    };

    playerBackward = event => {
        event.preventDefault();
        const player = window.jwplayer('my-unique-id');

        if(player.getPosition() > 10) {

            var newPosition = player.getPosition() - 10;

            player.seek(newPosition);

        } 
    };

    playerForward = event => {
        event.preventDefault();
        const player = window.jwplayer('my-unique-id');

        var newPosition = player.getPosition() + 10;

        player.seek(newPosition);
    };

    playerVolume = (event,value) => {
        event.preventDefault();
        const player = window.jwplayer('my-unique-id');

        const setVolume = parseInt(value);
        if(setVolume <= 0) {

            player.setMute(true);

            if(player.getMute() == true) {

                $('#player-unmute-button-item').hide();
                $('#player-mute-button-item').show();

            }
        } else {
            player.setMute(false);
        }

        player.setVolume(setVolume);

        this.setState({
            currentVolume: value,
        });
    };

    playerPlay = (event) => {
        event.preventDefault();
        const player = window.jwplayer('my-unique-id');
        player.play();
        $('#player-play-item').hide();
        $('#player-pause-item').show();
    };

    playerPause  = (event) => {
        event.preventDefault();
        const player = window.jwplayer('my-unique-id');
        player.pause();
        $('#player-pause-item').hide();
        $('#player-play-item').show();
    };

    playerMute = (event) => {

        event.preventDefault();
        const player = window.jwplayer('my-unique-id');
        player.setMute(true);
        $('#player-unmute-button-item').hide();
        $('#player-mute-button-item').show();
        this.setState({
            currentVolume: 0,
        });
    };

    playerUnmute = (event) => {
        event.preventDefault();
        const player = window.jwplayer('my-unique-id');
        player.setMute(false);
        this.setState({
            currentVolume: player.getVolume(),
        });
        $('#player-unmute-button-item').show();
        $('#player-mute-button-item').hide();
    };

    playerDuration = (e,value) => {
        let player = window.jwplayer('my-unique-id');
        let total_duration = player.getDuration();
        let current_position = e.position;
        let percentage = ( current_position / total_duration ) * 100;
        this.setState({
            currentDuration: percentage
        });
    };

    handlePlayVideo = async (event, admin_video_id) => {
        event.preventDefault();
    
        let inputData = {
            ...this.state.inputData,
            admin_video_id: admin_video_id,
        };
        
        await this.onlySingleVideoFirst(inputData);
        console.log(this.state.videoDetailsFirst.success);
        if (this.state.videoDetailsFirst.success === false) {
          ToastDemo(
            this.props.toastManager,
            this.state.videoDetailsFirst.error_messages,
            "error"
          );
        } else {
          this.redirectStatus(this.state.videoDetailsFirst);
          this.setState({ playButtonClicked: true });
        }
    };

    setPlaybackspeed = (event,value) => {
        event.preventDefault();
        let player = window.jwplayer('my-unique-id');
        player.setPlaybackRate(value);
        this.setState({
            playbackSpeed: value+'x',
        });
    };

    playerFullscreenOn = (event) => {
        event.preventDefault();
        let player = window.jwplayer('my-unique-id');
        player.setFullscreen(true);
        // $('#player-fullscreen-on').hide();
        // $('#player-fullscreen-off').show();
    };

    playerFullscreenOff = (event) => {
        event.preventDefault();
        let player = window.jwplayer('my-unique-id');
        player.setFullscreen(false);
        $('#player-fullscreen-off').hide();
        $('#player-fullscreen-on').show();
    };

    onReady = () => {
        let player = window.jwplayer('my-unique-id');
    };

    playerSetCaption = (event,value) => {
        event.preventDefault();
        let player = window.jwplayer('my-unique-id');
        console.log(player.getCurrentCaptions());
        player.setCurrentCaptions(value+1);
    };

    playerSetTrack = (event,value) => {
        event.preventDefault();
        let player = window.jwplayer('my-unique-id');
        console.log(player.getAudioTracks());
        console.log(player.getAudioTracks());
        console.log(player.getCurrentAudioTrack());
        
        player.setCurrentAudioTrack(value+1);
    };

    skipIntro = (event,time) => {
        event.preventDefault();
        let player = window.jwplayer('my-unique-id');
        player.seek(time);
        $('#skip-intro-sec').hide();
    };

    render() {
        
        if (this.state.playButtonClicked) {
            const returnToVideo = this.renderRedirectPage(
                this.state.videoDetailsFirst
            );

            if (returnToVideo != null) {
                return returnToVideo;
            }
        }

        // const pageType = "videoPage";
    
        // if (this.state.onPlayStarted) {
            
        //     const returnToVideo = this.renderRedirectPage(
        //         this.state.videoDetailsFirst,
        //         pageType
        //     );
        //     console.log(returnToVideo);
        //     if (returnToVideo != null) {
        //         return returnToVideo;
        //     }
        // }
        const { loadingFirst,loadingPlayerInfo,playbackSpeed } = this.state;

        let mainVideo, videoTitle, videoType, subTitle;

        if (loadingFirst && loadingPlayerInfo) {
            return <ContentLoader />;
        } else {
            // Check the whether we need to play the trailer or main video

            if (this.props.location.state.videoFrom != undefined) {
                subTitle = this.state.videoDetailsFirst.video_subtitle_vtt;

                if (this.props.location.state.videoFrom == "trailer") {
                    mainVideo = this.state.videoDetailsFirst.resolutions.original;
                    subTitle = this.state.videoDetailsFirst.trailer_subtitle;
                } else {
                    mainVideo = this.state.videoDetailsFirst.resolutions.original;
                }

                videoTitle = this.state.videoDetailsFirst.name;

                videoType = this.state.videoDetailsFirst.video_type;
            } else {
                mainVideo = this.state.videoDetailsFirst.main_video;

                subTitle = this.state.videoDetailsFirst.video_subtitle_vtt;

                videoTitle = this.state.videoDetailsFirst.title;

                videoType = this.state.videoDetailsFirst.video_type;
            }

            var stitles = []; var atrack = [];

            if(!this.state.loadingPlayerInfo && this.state.videoPlayerInfo.subtitles.length > 0){
                
                this.state.videoPlayerInfo.subtitles.forEach((resource, index) => {
                    stitles.push({'file': resource.subtitle, 'label': resource.language, 'kind': 'captions'});
                });
            } 
            
            if(!this.state.loadingPlayerInfo && this.state.videoPlayerInfo.audio_tracks.length > 0){

                this.state.videoPlayerInfo.audio_tracks.forEach((value, index) => {
                    atrack.push({'file': value.audio, 'name': value.language});
                });
            } 

            const playlist = [
                {
                    file: mainVideo,
                    image: this.state.videoDetailsFirst.default_image,
                    captions: stitles,
                }
            ];

            return (
                <>
                    <div className="player-video-sec">
                        <ReactJWPlayer
                            ref={this.ref}
                            height= "100%"
                            width= "100%"
                            playerId='my-unique-id'
                            aspectRatio='inherit'
                            licenseKey={configuration.get("configData.jw_player_key_web")}
                            playerScript='https://content.jwplatform.com/libraries/Jq6HIbgz.js'
                            playlist={playlist}
                            onTime={this.playerDuration}
                            onAutoStart={this.onVideoPlay}
                            onReady={this.onReady}
                            onOneHundredPercent={this.onCompleteVideo}
                            onPause={this.onPauseVideo}
                            customProps={{
                                skin: {
                                name: 'Netflix',
                                },
                                autostart: true,
                                mute: false, 
                            }}
                        />
                        {this.state.videoDetailsFirst.skip_intro_seconds > 0 ? 
                        <div className="skip-intro-sec" id="skip-intro-sec">
                            <Button className="btn skip-intro-btn" onClick={(event) => this.skipIntro(event,this.state.videoDetailsFirst.skip_intro_seconds)}>Skip Intro</Button>
                        </div>
                        :""}
                        <div className="top-control-sec">
                            <Link to="/home">
                                <Image
                                    src={
                                        window.location.origin +
                                        "/assets/img/video-player-icons/back-arrow-icon.svg"
                                    }
                                    alt=""
                                    className="back-icon"
                                />
                            </Link>
                        </div>
                        <div className="center-control-sec">
                            <Link to="#">
                                <div className="center-play-icon-sec">
                                    <Image
                                        src={
                                            window.location.origin +
                                            "/assets/img/video-player-icons/play-icon.svg"
                                        }
                                        alt=""
                                        className="center-play-icon"
                                    />
                                </div>
                            </Link>
                        </div>
                        <div className="bottom-control-sec">
                            <div className="video-progress-bar-sec">
                                <Form className="video-progress-bar">
                                    <Form.Group controlId="playerDuration">
                                        {/* <Form.Control type="range" min="0" max="100" value={this.state.currentDuration}
                                            onChange={(event) => {
                                                this.playerDuration(event,event.currentTarget.value)
                                            }}
                                        /> */}
                                        <LinearProgress variant="determinate" value={this.state.currentDuration} 
                                            onChange={(event) => {
                                                this.playerDuration(event,event.currentTarget.value)
                                            }}
                                        />
                                    </Form.Group>
                                </Form>
                                <div className="running-time-sec">
                                <p className="running-time">{this.state.videoDetailsFirst.duration}</p>
                                </div>
                            </div>
                            <div className="video-control-bottom-sec">
                                <ul className="list-unstyled control-sec">
                                    <Media as="li" id="player-play-item" style={{display: "none"}}>
                                        <Link to="#" onClick={(event) => this.playerPlay(event)}>
                                            <Image
                                                src={
                                                    window.location.origin +
                                                    "/assets/img/video-player-icons/play-icon.svg"
                                                }
                                                alt=""
                                                className="control-icon"
                                            />
                                        </Link>
                                    </Media>
                                    
                                    <Media as="li" id="player-pause-item">
                                        <Link to="#" onClick={(event) => this.playerPause(event)}>
                                            <Image
                                                src={
                                                    window.location.origin +
                                                    "/assets/img/video-player-icons/pause-icon.svg"
                                                }
                                                alt=""
                                                className="control-icon"
                                            />
                                        </Link>
                                    </Media>

                                    <Media as="li">
                                        <Link to="#" onClick={(event) => this.playerBackward(event)}>
                                            <Image
                                                src={
                                                    window.location.origin +
                                                    "/assets/img/video-player-icons/backward-icon.svg"
                                                }
                                                alt=""
                                                className="control-icon"
                                            />
                                        </Link>
                                    </Media>
                                    <Media as="li">
                                        <Link to="#" onClick={(event) => this.playerForward(event)}>
                                            <Image
                                                src={
                                                    window.location.origin +
                                                    "/assets/img/video-player-icons/forward-icon.svg"
                                                }
                                                alt=""
                                                className="control-icon"
                                            />
                                        </Link>
                                    </Media>
                                    <Media as="li" className="audio-icon">
                                        <Link to="#" id="player-unmute-button-item" onClick={(event) => this.playerMute(event)}>
                                            <Image
                                                src={
                                                    window.location.origin +
                                                    "/assets/img/video-player-icons/audio-full-icon.svg"
                                                }
                                                alt=""
                                                className="control-icon"
                                            />
                                        </Link>
                                        <Link to="#" id="player-mute-button-item" onClick={(event) => this.playerUnmute(event)} style={{display: "none"}}>
                                            <Image
                                                src={
                                                    window.location.origin +
                                                    "/assets/img/video-player-icons/audio-mute-icon.svg"
                                                }
                                                alt=""
                                                className="control-icon"
                                            />
                                        </Link>
                                        <div className="audio-progress-bar-sec">
                                            <Form className="audio-progress-bar">
                                                <Form.Group controlId="playerVolume">
                                                    <Form.Control type="range" id="player-volume-input" min="0" max="100" step="10" value={this.state.currentVolume}
                                                        onChange={(event) => {
                                                            this.playerVolume(event,event.currentTarget.value)
                                                        }}
                                                    />
                                                </Form.Group>
                                            </Form>
                                        </div>
                                    </Media>
                                    <Media as="li">
                                        <p className="video-main-title">{videoTitle}</p>
                                    </Media>
                                </ul>
                                <ul className="list-unstyled control-sec resp-center-control">
                                    <Media as="li" className="question-icon">
                                        <Image
                                            src={
                                                window.location.origin +
                                                "/assets/img/video-player-icons/question-icon.svg"
                                            }
                                            alt=""
                                            className="control-icon"
                                        />
                                        <div className="hoverable-question-icon">
                                            <Link to={{
                                                pathname: `/page/contact`,
                                                }} 
                                                className="question-info">Something wrong? Tell us.</Link>
                                        </div>
                                    </Media>
                                    {this.state.videoDetailsFirst.next_admin_video_id ? 
                                    <Media as="li" className="next-episode-icon">
                                        <Link onClick={(event) =>
                                            this.handlePlayVideo(event, this.state.videoDetailsFirst.next_admin_video_id)
                                        } to="#">
                                            <Image
                                                src={
                                                    window.location.origin +
                                                    "/assets/img/video-player-icons/next-video-icon.svg"
                                                }
                                                alt=""
                                                className="control-icon"
                                            />
                                        </Link>
                                        <div className="hoverable-next-episode-icon">
                                            <Link 
                                                onClick={(event) =>
                                                    this.handlePlayVideo(event, this.state.videoDetailsFirst.next_admin_video_id)
                                                }
                                                to="#"
                                            >
                                                <div className="header-sec">
                                                    <h6>Next Episode</h6>
                                                </div>
                                                <div className="body-sec">
                                                    <div className="next-video-sec">
                                                        <Image
                                                            src={this.state.videoDetailsFirst.next_video_details.default_image}
                                                            alt={this.state.videoDetailsFirst.next_video_details.title}
                                                            className="next-video-img"
                                                        />
                                                        <div className="center-play-icon-small-sec">
                                                            <Image
                                                                src={
                                                                    window.location.origin +
                                                                    "/assets/img/video-player-icons/play-icon.svg"
                                                                }
                                                                alt=""
                                                                className="center-play-icon"
                                                            />
                                                        </div>
                                                    </div>
                                                    <div className="next-video-details-sec">
                                                        <h6 className="title">{this.state.videoDetailsFirst.next_video_details.title}</h6>
                                                        <p className="desc">{this.state.videoDetailsFirst.next_video_details.description}
                                                        </p>
                                                    </div>
                                                </div>
                                            </Link>
                                        </div>
                                    </Media>
                                    : ""}
                                    {this.state.videoDetailsFirst.is_series == 1 ? 
                                    <Media as="li" className="next-season-icon">
                                        <Image
                                            src={
                                                window.location.origin +
                                                "/assets/img/video-player-icons/season-icon.svg"
                                            }
                                            alt=""
                                            className="control-icon"
                                        />
                                        <div className="hoverable-next-season-icon">
                                                <div className="header-sec">
                                                    <h6>Season 1</h6>
                                                </div>
                                                <div className="body-sec">
                                                    <Accordion defaultActiveKey={this.state.videoDetailsFirst.admin_video_id}>
                                                        {this.state.videoDetailsFirst.video_playlist.length > 0 ? (
                                                            this.state.videoDetailsFirst.video_playlist.map((playlist,key) =>
                                                        <Card className="season-card-sec">
                                                            <Card.Header>
                                                                <h2 className="mb-0">   
                                                                    <Accordion.Toggle as={Button} variant="link" eventKey={playlist.id} className="btn-block text-left title">
                                                                    {playlist.title}
                                                                    </Accordion.Toggle>
                                                                </h2>
                                                            </Card.Header>
                                                            <Accordion.Collapse eventKey={playlist.id}>
                                                                <Link onClick={(event) =>
                                                                    this.handlePlayVideo(event, playlist.id)
                                                                } to="#">
                                                                    <Card.Body className="season-card-body-sec">
                                                                        <div className="next-video-sec">
                                                                            <Image
                                                                                src={playlist.default_image}
                                                                                alt={playlist.title}
                                                                                className="next-video-img"
                                                                            />
                                                                            <div className="center-play-icon-small-sec">
                                                                                <Image
                                                                                    src={
                                                                                        window.location.origin +
                                                                                        "/assets/img/video-player-icons/play-icon.svg"
                                                                                    }
                                                                                    alt=""
                                                                                    className="center-play-icon"
                                                                                />
                                                                            </div>
                                                                        </div>
                                                                        <div className="next-video-details-sec">
                                                                            <h6 className="title">{playlist.title}</h6>
                                                                            <p className="desc">{playlist.description}
                                                                            </p>
                                                                        </div>
                                                                    </Card.Body>
                                                                </Link>
                                                            </Accordion.Collapse>
                                                        </Card>
                                                        )) : ''}
                                                    </Accordion>
                                                </div>
                                        </div>
                                    </Media>
                                    : ""}
                                    {!loadingPlayerInfo && this.state.videoPlayerInfo.audio_tracks.length > 0 ? 
                                    <Media as="li" className="sub-audio-icon">
                                        <Image
                                            src={
                                                window.location.origin +
                                                "/assets/img/video-player-icons/subtitle-icon.svg"
                                            }
                                            alt=""
                                            className="control-icon"
                                        />
                                        <div className="hoverable-sub-audio-icon">
                                            <div className="audio-sec">
                                                <h6 className="title-head">Audio</h6>
                                                <ul className="list-unstyled sub-audio-list">
                                                    
                                                    {this.state.videoPlayerInfo.audio_tracks.map((audio_track,key) => (

                                                        <Media as="li">
                                                            <Link to="#" onClick={(event) =>this.playerSetTrack(event, key)}>
                                                                { key ==0 ?
                                                                <Image
                                                                    src={
                                                                        window.location.origin +
                                                                        "/assets/img/video-player-icons/tick.svg"
                                                                    }
                                                                    alt=""
                                                                    className="tick-icon"
                                                                />
                                                                : ''}
                                                                {audio_track.language}
                                                            </Link>
                                                        </Media>

                                                    ))}
                                                    
                                                </ul>
                                            </div>
                                            <div className="subtitle-sec">
                                                <h6 className="title-head">Subtitles</h6>
                                                <ul className="list-unstyled sub-audio-list">
                                                    {!loadingPlayerInfo && this.state.videoPlayerInfo.subtitles.length > 0 ? (
                                                    this.state.videoPlayerInfo.subtitles.map((subtitle,key) => (
                                                        <Media as="li">
                                                            <Link to="#"  onClick={(event) =>this.playerSetCaption(event, key)}>
                                                                { key ==0 ?
                                                                <Image
                                                                    src={
                                                                        window.location.origin +
                                                                        "/assets/img/video-player-icons/tick.svg"
                                                                    }
                                                                    alt=""
                                                                    className="tick-icon"
                                                                />
                                                                : '' }
                                                                {subtitle.language}
                                                            </Link>
                                                        </Media>
                                                    ))) : ''}
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </Media>
                                    : ''}
                                    <Media as="li" className="speed-icon">
                                        <Image
                                            src={
                                                window.location.origin +
                                                "/assets/img/video-player-icons/speed-icon.svg"
                                            }
                                            alt=""
                                            className="control-icon"
                                        />
                                        <div className="hoverable-speed-icon">
                                            <h5 className="speed-title-head">Playback Speed</h5>
                                            <Form>
                                                <div className="bar">
                                                    <input className="bar-input" type="radio" name="input" id="input_0" />
                                                    <div className={playbackSpeed === "1.5x" ? "bar-view active" : "bar-view"} onClick={(event) =>this.setPlaybackspeed(event, 1.5)}>
                                                        <label className="bar-button" for="input_0">
                                                            <i className="fas fa-circle"></i>
                                                        </label>
                                                        <p className="desc">1.5x</p>
                                                    </div>
                                                    <input className="bar-input" type="radio" name="input" id="input_1" />
                                                    <div className={playbackSpeed === "1.25x" ? "bar-view active" : "bar-view"} onClick={(event) =>this.setPlaybackspeed(event, 1.25)}>
                                                        <label className="bar-button" for="input_1">
                                                            <i className="fas fa-circle"></i>
                                                        </label>
                                                        <p className="desc">1.25x</p>
                                                    </div>
                                                    <input className="bar-input" type="radio" name="input" id="input_2" />
                                                    <div className={playbackSpeed === "1x" ? "bar-view active" : "bar-view"} onClick={(event) =>this.setPlaybackspeed(event, 1)}>
                                                        <label className="bar-button" for="input_2">
                                                            <i className="fas fa-circle"></i>
                                                        </label>
                                                        <p className="desc">1x(Normal)</p>
                                                    </div>
                                                    <input className="bar-input" type="radio" name="input" id="input_3" />
                                                    <div className={playbackSpeed === "0.75x" ? "bar-view active" : "bar-view"} onClick={(event) =>this.setPlaybackspeed(event, 0.75)}>
                                                        <label className="bar-button" for="input_3">
                                                            <i className="fas fa-circle"></i>
                                                        </label>
                                                        <p className="desc">0.75x</p>
                                                    </div>
                                                    <input className="bar-input" type="radio" name="input" id="input_4" />
                                                    <div className={playbackSpeed === "0.5x" ? "bar-view active" : "bar-view"} onClick={(event) =>this.setPlaybackspeed(event, 0.5)}>
                                                        <label className="bar-button" for="input_4">
                                                            <i className="fas fa-circle"></i>
                                                        </label>
                                                        <p className="desc">0.5x</p>
                                                    </div>
                                                </div>
                                            </Form>
                                        </div>
                                    </Media>
                                    <Media as="li" id="player-fullscreen-on">
                                        <Link to="#" onClick={(event) =>this.playerFullscreenOn(event)}>
                                            <Image
                                                src={
                                                    window.location.origin +
                                                    "/assets/img/video-player-icons/full-screen-icon.svg"
                                                }
                                                alt=""
                                                className="control-icon"
                                            />
                                        </Link>
                                    </Media>
                                    {/* <Media as="li" id="player-fullscreen-off" style={{display: "none"}}>
                                        <Link to="#" onClick={(event) =>this.playerFullscreenOff(event)}>
                                            <Image
                                                src={
                                                    window.location.origin +
                                                    "/assets/img/video-player-icons/full-screen-exit.svg"
                                                }
                                                alt=""
                                                className="control-icon"
                                            />
                                        </Link>
                                    </Media> */}
                                </ul>
                            </div>
                        </div>
                    </div>
                </>
            );
        }
    }
};

export default VideoPLayerIndex;