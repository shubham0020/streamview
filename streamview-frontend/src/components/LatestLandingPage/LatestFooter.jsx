import React, { Component } from "react";
import api from "../../Environment";

import { Link } from "react-router-dom";
import "./LatestLandingPageResponsive.css";
import "./LatestLandingPage.css";
import { setLanguage, translate, t } from "react-multi-lang";
import configuration from "react-global-configuration";
const $ = window.$;

class LatestFooter extends Component {
  state = {
    isAuthenticated: this.props.data,
    footer_pages1: [],
    footer_pages2: [],
    loading: true,
    footerList: null,
  };

  componentDidMount() {
    api
      .getMethod("pages/list")
      .then((response) => {
        if (response.data.success) {
          this.setState({
            loading: false,
            footerList: response.data.data,
          });
        } else {
        }
      })
      .catch(function(error) {});

    var footerHeight = $("#footer").outerHeight();
    var deviceheight = $(window).outerHeight();
    var contentheight = deviceheight - footerHeight - 66;
    $(".main-sec-content").css("min-height", contentheight);

    // $(".bottom-height").height(footerHeight);
    // Call api function

    if (configuration.get("configData.footer_pages1")) {
      this.setState({
        footer_pages1: configuration.get("configData.footer_pages1"),
      });
    }
    if (configuration.get("configData.footer_pages2")) {
      this.setState({
        footer_pages2: configuration.get("configData.footer_pages2"),
      });
    }
  }

  handleChangeLang = ({ currentTarget: input }) => {
    setLanguage(input.value);
    localStorage.setItem("lang", input.value);
    window.location.reload();
  };
  render() {
    const { t } = this.props;
    const { loading, footer_pages1, footer_pages2 } = this.state;
    return (
      <>
        <div className="footer-sec">
          <div className="container">
            <div className="footer-sec-card">
              <div className="footer-site-sec">
                <p className="footer-top-title">
                  {t("questions_contact_us")}
                  {/* <Link to="#">000-800-040-1843</Link> */}
                </p>
                <ul className="list-unstyled footer-link">
                  {loading
                    ? t("loading")
                    : footer_pages1.length > 0
                    ? footer_pages1.map((static_page, index) => (
                        <li className="footer-link-item" key={`page1${index}`}>
                          <Link
                            to={{
                              pathname: `/page/${static_page.page_type}`,
                              state: {
                                page_id: static_page.page_id,
                              },
                            }}
                          >
                            <span>{static_page.heading}</span>
                          </Link>
                        </li>
                      ))
                    : ""}
                </ul>
                <ul className="list-unstyled footer-link">
                  {loading
                    ? t("loading")
                    : footer_pages2.length > 0
                    ? footer_pages2.map((static_page, index) => (
                        <li className="footer-link-item" key={`page2${index}`}>
                          <Link
                            to={{
                              pathname: `/page/${static_page.page_type}`,
                              state: {
                                page_id: static_page.page_id,
                              },
                            }}
                          >
                            <span>{static_page.heading}</span>
                          </Link>
                        </li>
                      ))
                    : ""}
                </ul>
                <ul className="list-unstyled footer-link">
                  {/* <li className="footer-link-item">
                    <a
                      href={configuration.get("configData.appstore")}
                      target="_blank"
                    >
                      <img
                        src="/assets/img/app-store.png"
                        className="app-img"
                        alt="Playstore"
                      />
                    </a>
                  </li>
                  <li className="footer-link-item">
                    <a
                      href={configuration.get("configData.playstore")}
                      target="_blank"
                    >
                      <img
                        src="/assets/img/play-store.png"
                        className="app-img"
                        alt="Playstore"
                      />
                    </a>
                  </li> */}
                </ul>
                <ul className="list-unstyled footer-link">
                  <li className="footer-link-item">
                    <Link to="#">
                      <span>Media Centre</span>
                    </Link>
                  </li>
                  <li className="footer-link-item">
                    <Link to="#">
                      <span>Terms of Use</span>
                    </Link>
                  </li>
                  <li className="footer-link-item">
                    <Link to="#">
                      <span>Contact Us</span>
                    </Link>
                  </li>
                </ul>
                <div className="row">
                  <div className="col-md-12">
                    <div className="row">
                      <div className="col-md-2">
                        <div class="dropdown">
                          <button
                            class="btn btn-secondary dropdown-toggle language-dropdown"
                            type="button"
                            id="dropdownMenuButton"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >
                            <i class="fas fa-globe mr-3"></i>English
                          </button>
                          <div
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton"
                          >
                            <a class="dropdown-item" href="#">
                              English
                            </a>
                            <a class="dropdown-item" href="#">
                              हिन्दी
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div className="row">
                  <div className="col-md-12">
                    <p className="footer-company-name">
                      {configuration.get("configData.site_name")} India
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </>
    );
  }
}

export default translate(LatestFooter);
