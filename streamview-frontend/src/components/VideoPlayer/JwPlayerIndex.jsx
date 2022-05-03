import React, {Component} from 'react';
import { Row, Col, Image, Form, Media, Accordion, Card, Button } from "react-bootstrap";
import "./VideoPlayer.css";
import { Link } from "react-router-dom";
import Helper from "../Helper/helper";
import ReactJWPlayer from 'react-jw-player';
import PlayerJs from "./player.js";

class JwPlayerIndex extends Component {

    constructor(props){
        super(props);
    }

    ref = (player) => {
        this.player = player;
    };

    onReady = async () => {
        // interact with JW Player API here
        const player = window.jwplayer('my-unique-id');
        var myFFButton = document.createElement("div");
	    myFFButton.id = "myFFButton";
	    myFFButton.setAttribute('style',"margin-left: 0px; margin-bottom: -8px; background-image: url('https://s3.amazonaws.com/static.sourcecreative.com/icons/ff.svg');background-repeat: no-repeat;background-size:contain;");
	    myFFButton.setAttribute('class','jw-icon jw-icon-inline jw-button-color jw-reset');
        myFFButton.setAttribute('onclick', this.playerForward);
        var leftGroup = document.getElementById('my-unique-id');
	    leftGroup.insertBefore(myFFButton, leftGroup.childNodes[2]);
    };

    playerForward = () => {
        const player = window.jwplayer('my-unique-id');
    
        console.log(player.getPosition());
    
    }
    render() {
        
        const playlist = [
            {
                file: 'https://streamview-backend.bytecollar.com/uploads/videos/original/SV-2021-08-11-15-53-41-bb5b34ce30bb3c44fb933ae9603fc6f0ae3c9dc0.mp4',
                image: 'https://streamview-backend.bytecollar.com/uploads/images/video_23_001.jpg',
                tracks: [{
                    file: 'https://link-to-subtitles.vtt',
                    label: 'English',
                    kind: 'captions',
                    'default': true
                }],
            },
            {
                file: 'https://streamview-backend.bytecollar.com/uploads/videos/original/SV-2021-08-11-15-53-41-bb5b34ce30bb3c44fb933ae9603fc6f0ae3c9dc0.mp4',
                image: 'https://streamview-backend.bytecollar.com/uploads/images/video_23_001.jpg',
            }
        ];
 
      
        return (
            <>
                <div className="react-jw-player-container">
                    <ReactJWPlayer
                        height= "100%"
                        width= "100%"
                        playerId='my-unique-id'
                        aspectRatio='inherit'
                        onReady={this.onReady}
                        playerScript='https://content.jwplatform.com/libraries/Jq6HIbgz.js'
                        playlist={playlist}
                        customProps={{
                            skin: {
                              name: 'Netflix',
                            },
                        }}
                    />
                    
                </div>
            </>
        );

    }
};

export default JwPlayerIndex;