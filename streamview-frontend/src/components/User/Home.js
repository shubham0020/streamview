import React, { Component } from "react";
import { Link } from "react-router-dom";
import api from "../../Environment";

import Slider from "../SliderView/MainSlider";
import HomePageBanner from "./homePageBanner";
import HomeLoader from "../Loader/HomeLoader";
import { translate } from "react-multi-lang";
import Helper from "../Helper/helper";

class Home extends Helper {
  state = {
    maindata: null,
    errorHandle: 0,
    loading: true,
    banner: null,
    loadingHomeCatSection: true,
    homeCatData: null,
  };

  componentDidMount() {
    const inputData = {
      page_type: "HOME",
    };
    api
      .postMethod("home_first_section", inputData)
      .then((response) => {
        if (response.data.success === true) {
          let maindata = response.data.data;
          let banner = response.data.banner;

          this.setState({
            loading: false,
            maindata: maindata,
            banner: banner,
          });
        } else {
          let errorHandle = 1;
          this.setState({ errorHandle });
          this.errorCodeChecker(response.data.error_code);
        }
      })
      .catch(function(error) {});
    api
      .postMethod("home_category_section", inputData)
      .then((response) => {
        if (response.data.success === true) {
          this.setState({
            loadingHomeCatSection: false,
            homeCatData: response.data.data,
          });
        } else {
          let errorHandle = 1;
          this.setState({ errorHandle });
        }
      })
      .catch(function(error) {});
  }

  renderVideoList = (maindata, index) => {
    return (
      <React.Fragment key={index}>
        <div className="main-slidersec">
          <Link
            to={{
              pathname: "/view-all",
              state: {
                url_type: maindata.url_type,
                url_type_id: maindata.url_type_id,
                page_type: "HOME",
                title: maindata.title,
              },
            }}
          >
            <h3 className="">
              {maindata.title}
              <i className="fas fa-angle-right ml-2" />
            </h3>
          </Link>

          <Slider>
            {maindata.data.map((movie) => (
              <Slider.Item movie={movie} key={movie.admin_video_id}>
                item1
              </Slider.Item>
            ))}
          </Slider>
        </div>
      </React.Fragment>
    );
  };

  renderVideoNoData = (maindata, index) => {
    return (
      <React.Fragment key={index}>
        <div className="main-slidersec">
          <h3 className="">
            {maindata.title}
            <i className="fas fa-angle-right ml-2" />
          </h3>

          <div className="no-data">
            No Videos Found!!
          </div>
        </div>
      </React.Fragment>
    );
  };

  render() {
    const { t } = this.props;

    const {
      loading,
      maindata,
      banner,
      loadingHomeCatSection,
      homeCatData,
    } = this.state;

    return (
      <div className="main-sec-content">
        {loading ? <HomeLoader /> : <HomePageBanner banner={banner} />}
        <div className="main p-40 home-slider-top">
          {/* {renderMyList} */}

          {loading
            ? ""
            : maindata.map((mainDa, index) =>
                mainDa.data.length === 0
                  ? this.renderVideoNoData(mainDa, index)
                  : loading
                  ? t("loading")
                  : this.renderVideoList(mainDa, index)
              )}
          {loadingHomeCatSection
            ? ""
            : homeCatData.map((mainDa, index) =>
                mainDa.data.length === 0
                  ? ""
                  : loading
                  ? t("loading")
                  : this.renderVideoList(mainDa, index)
              )}

          <div className="height-100" />
        </div>
      </div>
    );
  }
}

export default translate(Home);
