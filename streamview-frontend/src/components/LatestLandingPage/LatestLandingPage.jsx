import React, { Component } from "react";
import { Link, Redirect } from "react-router-dom";
import "./LatestLandingPageResponsive.css";
import "./LatestLandingPage.css";
import BannerImageBg from "./banner-new-bg.jpg";
import configuration from "react-global-configuration";
import { apiConstants } from "../../components/Constant/constants";
import { translate, getLanguage, t } from "react-multi-lang";
import LatestFooter from "./LatestFooter";
import Footer from "../Layouts/SubLayout/Footer";
import api from "../../Environment";
import renderHTML from "react-render-html";
import ImageLoader from "../Helper/ImageLoader";

class LatestLandingPage extends Component {
  state = {
    HomeSettings: [],
    loading: true,
    loadingData: true,
    faqData: null,
  };
  componentDidMount() {
    this.fetchConfig();
    this.getFaqs();
  }

  async fetchConfig() {
    const response = await fetch(apiConstants.homeSettingsUrl);
    const homeResonse = await response.json();

    this.setState({
      loading: false,
      HomeSettings: homeResonse.data,
    });
  }

  async getFaqs() {
    api.getMethod("faqs/list").then((response) => {
      if (response.data.success) {
        this.setState({
          faqData: response.data.data,
          loadingData: false,
        });
      } else {
      }
    });
  }
  render() {
    const { loading, HomeSettings, loadingData, faqData } = this.state;

    if (
      localStorage.getItem("userId") &&
      localStorage.getItem("active_profile_id") &&
      localStorage.getItem("accessToken")
    )
      return <Redirect to="/home" />;
    return (
      <>
        <div
          className="latest-landing-sec"
          style={{
            backgroundImage: `url(${HomeSettings.home_page_bg_image})`,
          }}
        >
          <div className="latest-landing-header">
            <img
              src={configuration.get("configData.site_logo")}
              className="new-logo"
              alt={configuration.get("configData.site_name")}
            />
            <Link to="/login" className="signin-btn">
              {t("signin")}
            </Link>
          </div>
          <div className="latest-banner-content">
            <div className="latest-banner-content-info">
              <h1 className="banner-title">
                {HomeSettings.home_banner_heading}
              </h1>
              <h2 className="banner-subtitle">
                {HomeSettings.home_banner_note}
              </h2>
              <p className="banner-desc">
                {HomeSettings.home_banner_description}
              </p>
            </div>
            <div className="latest-banner-content-info-form">
              <ul className="list-unstyled banner-theme-form">
                {/* <li>
                  <form className="theme-form-sec">
                    <div className="form-group">
                      <input
                        type="email"
                        className="form-control"
                        placeholder="Email address"
                      />
                    </div>
                  </form>
                </li>  */}
                <li>
                  <button className="btn btn-search">
                    <Link to="/register">
                      {t("getting_started")}{" "}
                      <i className="fas fa-chevron-right ml-2"></i>
                    </Link>
                  </button>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div className="latest-landing-about-sec">
          <div className="container">
            <div className="row">
              <div className="col-md-6">
                <div className="about-details">
                  <h2 className="about-title">
                    {HomeSettings.home_section_1_title}
                  </h2>
                  <h4 className="about-desc">
                    {HomeSettings.home_section_1_description}
                  </h4>
                </div>
              </div>
              <div className="col-md-6">
                <div className="tv-img-sec">
                  <img src="assets/img/tv-1.png" className="tv-img" />
                </div>
                <div className="about-video-sec">
                  <video
                    className="our-about-card-video"
                    autoplay="true"
                    playsinline=""
                    muted=""
                    loop="true"
                    id="vid"
                    key={HomeSettings.home_section_1_video}
                  >
                    <source
                      src={HomeSettings.home_section_1_video}
                      type="video/mp4"
                    />
                  </video>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div className="latest-download-sec">
          <div className="container">
            <div className="row">
              <div className="col-md-6 d-block d-sm-none">
                <div className="download-details">
                  <h2 className="download-title">
                    {HomeSettings.home_section_2_title}
                  </h2>
                  <h4 className="download-desc">
                    {HomeSettings.home_section_2_description}
                  </h4>
                </div>
              </div>
              <div className="col-md-6">
                <div className="mobile-img-sec">
                  <ImageLoader
                    image={HomeSettings.home_section_2_image}
                    className="mobile-img"
                    alt="mobile-img"
                  />
                </div>
                <div className="our-download-card">
                  <div className="our-download-info">
                    <div className="our-download-card-image">
                      <ImageLoader
                        alt=""
                        image={HomeSettings.home_section_2_mob_image}
                        className="book-img"
                      />
                    </div>
                    <div className="our-download-card-text">
                      <h4 className="download-sub-title">
                        {HomeSettings.home_section_2_image_title}
                      </h4>
                      <p className="download-sub-desc">{t("downloading")}...</p>
                    </div>
                  </div>
                  <div className="download-gif-img-sec">
                    <img
                      src="assets/img/download-icon.gif"
                      className="download-gif-img"
                    />
                  </div>
                </div>
              </div>
              <div className="col-md-6 d-none d-sm-block">
                <div className="download-details">
                  <h2 className="download-title">
                    {HomeSettings.home_section_2_title}
                  </h2>
                  <h4 className="download-desc">
                    {HomeSettings.home_section_2_description}
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div className="latest-watch-everywhere-sec">
          <div className="container">
            <div className="row">
              <div className="col-md-6">
                <div className="watch-everywhere-details">
                  <h2 className="watch-everywhere-title">
                    {HomeSettings.home_section_3_title}
                  </h2>
                  <h4 className="watch-everywhere-desc">
                    {HomeSettings.home_section_3_description}
                  </h4>
                </div>
              </div>
              <div className="col-md-6">
                <div className="all-device-img-sec">
                  <ImageLoader
                    alt=""
                    image={HomeSettings.home_section_3_cover_image}
                    className="all-device-img"
                  />
                </div>
                <div className="watch-everywhere-video-sec">
                  <video
                    className="our-watch-everywhere-card-video"
                    autoplay="true"
                    playsinline=""
                    muted=""
                    loop="true"
                    id="vid"
                    key={HomeSettings.home_section_3_video}
                  >
                    <source
                      src={HomeSettings.home_section_3_video}
                      type="video/mp4"
                    />
                  </video>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div className="latest-faq-section">
          <div className="container">
            <div className="faq-lists-sec">
              <h1 className="section-title">{t("faq_title")}</h1>
              <div className="accordion" id="accordionExample">
                {loadingData
                  ? "Loading..."
                  : faqData.length > 0
                  ? faqData.map((faq) => (
                      <div className="card">
                        <div className="card-header" id={faq.unique_id}>
                          <h2 className="mb-0">
                            <button
                              className="btn btn-link btn-block text-left heading-title collapsed"
                              type="button"
                              data-toggle="collapse"
                              data-target={`#${faq.faq_id}`}
                              aria-expanded="false"
                              aria-controls="collapseOne"
                            >
                              {faq.question}
                            </button>
                          </h2>
                        </div>

                        <div
                          id={faq.faq_id}
                          className="collapse"
                          aria-labelledby={faq.unique_id}
                          data-parent="#accordionExample"
                        >
                          <div className="card-body">
                            {renderHTML(faq.answer)}
                          </div>
                        </div>
                      </div>
                    ))
                  : ""}
              </div>
              <div className="latest-banner-content-info-form">
                <p className="faq-desc">{t("ready_to_watch")}</p>
                <ul className="list-unstyled banner-theme-form form-align-center">
                  {/* <li>
                    <form className="theme-form-sec">
                      <div className="form-group">
                        <input
                          type="email"
                          className="form-control"
                          placeholder="Email address"
                        />
                      </div>
                    </form>
                  </li> */}
                  <li>
                    <button className="btn btn-search">
                      <Link to="/register">
                        {t("getting_started")}{" "}
                        <i className="fas fa-chevron-right ml-2"></i>
                      </Link>
                    </button>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        {/* <LatestFooter></LatestFooter> */}

        {/* <Footer></Footer> */}
      </>
    );
  }
}

export default LatestLandingPage;
