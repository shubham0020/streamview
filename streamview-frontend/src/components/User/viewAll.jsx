import React, { Component } from "react";

import Slider from "../SliderView/MainSlider";

import api from "../../Environment";
import ContentLoader from "../Static/contentLoader";
import { translate, t } from "react-multi-lang";

class ViewAll extends Component {
  state = {
    videoList: null,
    loading: true,
    skipCount: 0,
    loadMoreButtonDisable: false,
    loadingContent: null,
    mainData: null,
  };
  componentDidMount() {
    if (this.props.location.state) {
      //
    } else {
      window.location = "/home";
    }
    let inputData;
    let apiURL;
    if (this.props.location.state.videoType != undefined) {
      inputData = {
        skip: this.state.skipCount,
        cast_crew_id: this.props.location.state.cast_crew_id,
      };
      apiURL = "v4/cast_crews/videos";
    } else {
      inputData = {
        skip: this.state.skipCount,
        url_type: this.props.location.state.url_type,
        url_type_id: this.props.location.state.url_type_id,
        page_type: this.props.location.state.page_type,
        category_id: this.props.location.state.category_id,
        sub_category_id: this.props.location.state.sub_category_id,
      };
      apiURL = "see_all";
    }
    this.viewAllApiCall(inputData, apiURL);
  }

  //WARNING! To be deprecated in React v17. Use new lifecycle static getDerivedStateFromProps instead.
  // componentWillReceiveProps(nextProps) {
  //   let inputData;
  //   let apiURL;
  //   if (nextProps.location.state.videoType != undefined) {
  //     inputData = {
  //       skip: this.state.skipCount,
  //       cast_crew_id: nextProps.location.state.cast_crew_id,
  //     };
  //     apiURL = "v4/cast_crews/videos";
  //   } else {
  //     inputData = {
  //       skip: this.state.skipCount,
  //       url_type: nextProps.location.state.url_type,
  //       url_type_id: nextProps.location.state.url_type_id,
  //       page_type: nextProps.location.state.page_type,
  //       category_id: nextProps.location.state.category_id,
  //       sub_category_id: nextProps.location.state.sub_category_id,
  //     };
  //     apiURL = "see_all";
  //   }
  //   this.viewAllApiCall(inputData, apiURL);
  // }

  loadMore = (event) => {
    event.preventDefault();
    this.setState({
      loadMoreButtonDisable: true,
      loadingContent: "Loading...",
      loading: true,
    });
    const inputData = {
      skip: this.state.skipCount,
      url_type: this.props.location.state.url_type,
      url_type_id: this.props.location.state.url_type_id,
      page_type: this.props.location.state.page_type,
      category_id: this.props.location.state.category_id,
      sub_category_id: this.props.location.state.sub_category_id,
    };
    const apiURL = "see_all";
    this.viewAllApiCall(inputData, apiURL);
  };

  viewAllApiCall = (inputData, apiURL) => {
    let items;
    let secondItem;
    api
      .postMethod(apiURL, inputData)
      .then((response) => {
        if (response.data.success) {
          if (this.state.mainData != null) {
            items = [...this.state.mainData, ...response.data.data];
            secondItem = [...this.state.mainData, ...response.data.data];
          } else {
            items = [...response.data.data];
            secondItem = [...response.data.data];
          }
          console.log("Items", items);
          this.setState({
            mainData: items,
            videoList: secondItem,
            loading: false,
            skipCount: response.data.data.length + this.state.skipCount,
            loadMoreButtonDisable: false,
            loadingContent: null,
          });
          setTimeout(() => {
            console.log("State", this.state.videoList);
          }, 1000);
        } else {
        }
      })
      .catch(function(error) {});
  };

  chunkArray(myArray, chunk_size) {
    let results = [];

    while (myArray.length) {
      results.push(myArray.splice(0, chunk_size));
    }

    return results;
  }

  render() {
    // Usage

    let result = null;

    // Split in group of 3 items
    if (this.state.loading) {
      return <ContentLoader />;
    } else {
      result = this.chunkArray(this.state.videoList, 5);
    }
    // Outputs : [ [1,2,3] , [4,5,6] ,[7,8] ]

    return (
      <div className="main p-40">
        <div className="main-slidersec">
          <h3 className="">
            {this.props.location.state.title}
            <i className="fas fa-angle-right ml-2" />
          </h3>
          {result.map((res) => (
            <Slider key={res.index}>
              {res.map((movie) => (
                <Slider.Item movie={movie} key={movie.admin_video_id}>
                  item1
                </Slider.Item>
              ))}
            </Slider>
          ))}
        </div>
        <div>
          <button
            className="btn btn-lg"
            type="button"
            style={{ position: "absolute", left: "50%", margin: "10px" }}
            onClick={this.loadMore}
            disabled={this.state.loadMoreButtonDisable}
          >
            {this.state.loadingContent != null
              ? this.state.loadingContent
              : t("load_more")}
          </button>
        </div>
        <div className="height-100" />
      </div>
    );
  }
}

export default ViewAll;
