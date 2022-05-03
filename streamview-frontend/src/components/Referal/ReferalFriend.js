import React from "react";
import api from "../../Environment";
import Helper from "../Helper/helper";
import ToastDemo from "../Helper/toaster";
import { translate, t } from "react-multi-lang";
import configuration from "react-global-configuration";
import { CopyToClipboard } from "react-copy-to-clipboard";
import {
  FacebookShareButton,
  TwitterShareButton,
  WhatsappShareButton,
  EmailShareButton,
  RedditShareButton,
  FacebookIcon,
  TwitterIcon,
  WhatsappIcon,
  EmailIcon,
  RedditIcon,
} from "react-share";
const $ = window.$;

class ReferalFriend extends Helper {
  state = {
    // loading: true,
    data: {
      referral_code: "",
      referrals_signup_url: "",
      total_referrals: 0,
      referral_earnings_formatted: 0,
    },
  };

  componentDidMount() {
    this.getReferralDetails();
  }

  onCopy = () => {
    this.setState({ copied: true });

    $("#referral_copy_success")
      .html("copied")
      .fadeIn("slow");

    setTimeout(function() {
      $("#referral_copy_success").html("");
    }, 1000);
  };
  getReferralDetails = (event) => {
    api
      .postMethod("referral_code")
      .then((response) => {
        if (response.data.success) {
          this.setState({
            data: response.data.data,
            loading: false,
          });
        } else {
          if (response.data.error) {
            ToastDemo(this.props.toastManager, response.data.error, "error");
          }
        }
      })
      .catch((error) => {
        this.setState({ loadingContent: null, buttonDisable: false });

        if (error) {
          ToastDemo(this.props.toastManager, error, "error");
        }
      });
  };

  render() {
    const { loading, data } = this.state;

    return (
      <div>
        <div className="bg-color-white referal padding-center">
          <div className="container">
            <div className="row">
              <div className="col-md-12">
                <h1>
                  <img
                    src={
                      window.location.origin +
                      "/assets/img/referal-friend-chat.svg"
                    }
                    alt="menu_img"
                    className="referal-head-icon"
                  />
                  <div className="title">
                    {t("tell_friends_about")}{" "}
                    {configuration.get("configData.site_name")}
                  </div>
                </h1>
                <hr className="border-thick"></hr>
              </div>
            </div>
            <div className="referal-sub-sec">
              <div className="row">
                <div className="col-md-12">
                  <div className="">
                    <h2 className="sub-title">{t("referral_code_note")}</h2>
                    <h5 className="description">{data.referrals_signup_note}</h5>
                  </div>
                </div>
              </div>
              <div className="referal-sub-div">
                <div className="row">
                  <div className="col-md-6 resp-width">
                    <div className="referal-email">
                      <div className="input-group mb-3">
                        <input
                          type="text"
                          className="form-control"
                          disabled
                          placeholder={data.referrals_signup_url}
                        />
                        <div className="input-group-append">
                          <span className="input-group-text">
                            <CopyToClipboard
                              onCopy={this.onCopy}
                              text={data.referrals_signup_url}
                            >
                              <button className="btn btn-referal">
                                {t("copy_link")}
                              </button>
                            </CopyToClipboard>
                          </span>
                        </div>
                      </div>
                      <p
                        id="referral_copy_success"
                        className="text-success"
                      ></p>
                    </div>
                  </div>
                  <div className="col-md-6 resp-width resp-mrg-btm">
                    <div className="row resp-mrg-btm-1">
                      <div className="col-md-2 border-right-1 resp-width resp-no-border resp-mrg-btm">
                        <div className="text-center alternative-social">
                          <h2 className="social-desc big">Or</h2>
                        </div>
                      </div>
                      <div className="col-md-2 border-right-1 resp-width-1 resp-width-5 flex-box-content">
                        <div className="text-center social-link">
                          <div className="Demo__some-network">
                            <EmailShareButton
                              // url={
                              //     data.referrals_signup_url
                              // }
                              subject={configuration.get(
                                "configData.site_name"
                              )}
                              body={data.share_message}
                              className="Demo__some-network__share-button"
                            >
                              <EmailIcon size={32} round />
                            </EmailShareButton>
                          </div>
                          <h2 className="social-desc">{t("email")}</h2>
                        </div>
                      </div>
                      <div className="col-md-2 border-right-1 resp-width-1 resp-width-5 flex-box-content">
                        <div className="text-center social-link">
                          <WhatsappShareButton
                            url={data.referrals_signup_url}
                            title={data.share_message}
                            separator=":: "
                            className="Demo__some-network__share-button"
                          >
                            <WhatsappIcon size={32} round />
                          </WhatsappShareButton>
                          <h2 className="social-desc">{t("whatsapp")}</h2>
                        </div>
                      </div>
                      <div className="col-md-2 border-right-1 resp-width-1 resp-width-5 flex-box-content">
                        <div className="text-center social-link">
                          <FacebookShareButton
                            url={data.referrals_signup_url}
                            quote={data.share_message}
                            className="Demo__some-network__share-button"
                          >
                            <FacebookIcon size={32} round />
                          </FacebookShareButton>
                          <h2 className="social-desc">{t("facebook")}</h2>
                        </div>
                      </div>
                      <div className="col-md-2 border-right-1 resp-width-1 resp-width-5 flex-box-content">
                        <div className="text-center social-link">
                          <TwitterShareButton
                            url={data.referrals_signup_url}
                            title={data.share_message}
                            className="Demo__some-network__share-button"
                          >
                            <TwitterIcon size={32} round />
                          </TwitterShareButton>
                          <h2 className="social-desc">{t("twitter")}</h2>
                        </div>
                      </div>
                      <div className="col-md-2 border-right-1 resp-width-1 resp-width-5 flex-box-content">
                        <div className="text-center social-link">
                          <RedditShareButton
                            url={data.referrals_signup_url}
                            title={data.share_message}
                            windowWidth={660}
                            windowHeight={460}
                            className="Demo__some-network__share-button"
                          >
                            <RedditIcon size={32} round />
                          </RedditShareButton>
                          <h2 className="social-desc">{t("reddit")}</h2>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="row referal-count">
                <div className="col-md-6 resp-width">
                  <p className="desc mt-3">
                    <span>{t("total_referrals")}</span>
                    <strong>
                      <span className="float-right">
                        {data.total_referrals}
                      </span>
                    </strong>
                  </p>
                  <p className="desc no-margin">
                    {t("referral_earnings")}
                    <strong>
                      <span className="float-right">
                        {data.referral_earnings_formatted}
                      </span>
                    </strong>
                  </p>
                  <p className="desc no-margin">
                    {t("referee_earnings")}
                    <strong>
                      <span className="float-right">
                        {data.referee_earnings_formatted}
                      </span>
                    </strong>
                  </p>
                  <p className="desc no-margin">
                    {t("total_credits")}
                    <strong>
                      <span className="float-right">
                        {data.currency}
                        {data.amount_total ? data.amount_total : 0}
                      </span>
                    </strong>
                  </p>
                  <p className="desc no-margin">
                    {t("used_credits")}
                    <strong>
                      <span className="float-right">
                        {data.currency}
                        {data.amount_used ? data.amount_used : 0}
                      </span>
                    </strong>
                  </p>
                  <p className="desc no-margin">
                    {t("remaining_credits")}
                    <strong>
                      <span className="float-right">
                        {data.currency}
                        {data.remaining ? data.remaining : 0}
                      </span>
                    </strong>
                  </p>
                  <p className="desc no-margin">
                    {t("pending_credits")}
                    <strong>
                      <span className="float-right">
                        {data.currency}
                        {data.onhold ? data.onhold : 0}
                      </span>
                    </strong>
                  </p>
                </div>
              </div>
            </div>
            <div className="referal-sub-head">
              <h3 className="sub-head">{t("how_it_works_referral")}</h3>
            </div>
            <div className="row pt-45">
              <div className="col-md-4 resp-mrg-btm-1">
                <div className="referal-box">
                  <div className="referal-icon">
                    <img
                      src={
                        window.location.origin + "/assets/img/share-referal.svg"
                      }
                      alt="menu_img"
                      className="referal-head-icon"
                    />
                  </div>
                  <div className="referal-info">
                    <h4 className="referal-info-title">
                      {t("referral_step1")}
                    </h4>
                    <p className="referal-info-desc">
                      {t("referral_step1_content")}
                    </p>
                  </div>
                </div>
              </div>
              <div className="referal-arrow">
                <i className="fas fa-chevron-right"></i>
              </div>
              <div className="col-md-4 resp-mrg-btm-1">
                <div className="referal-box">
                  <div className="referal-icon">
                    <img
                      src={
                        window.location.origin +
                        "/assets/img/referal-friend.svg"
                      }
                      alt="menu_img"
                      className="referal-head-icon"
                    />
                  </div>
                  <div className="referal-info">
                    <h4 className="referal-info-title">
                      {t("referral_step2")}
                    </h4>
                    <p className="referal-info-desc">
                      {t("referral_step2_content")}
                    </p>
                  </div>
                </div>
              </div>
              <div className="referal-arrow-1">
                <i className="fas fa-chevron-right"></i>
              </div>
              <div className="col-md-4">
                <div className="referal-box">
                  <div className="referal-icon">
                    <img
                      src={window.location.origin + "/assets/img/message.svg"}
                      alt="menu_img"
                      className="referal-head-icon"
                    />
                  </div>
                  <div className="referal-info">
                    <h4 className="referal-info-title">
                      {t("referral_step3")}
                    </h4>
                    <p className="referal-info-desc">
                      {t("referral_step3_content")}
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <hr className="border-thin"></hr>
            <div className="referal-footer">
              {/* <a href="#">
                                <h5 className="referal-footer-desc">
                                    Netflix Referal Program Terms and Conditions
                                </h5>
                            </a> */}
            </div>
          </div>
        </div>
      </div>
    );
  }
}
export default translate(ReferalFriend);
