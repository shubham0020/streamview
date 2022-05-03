import React from "react";
import { Link } from "react-router-dom";
import Helper from "../Helper/helper";
import api from "../../Environment";
import { withToastManager } from "react-toast-notifications";
import ToastDemo from "../Helper/toaster";
import GoogleLogin from "react-google-login";
import FacebookLogin from "react-facebook-login/dist/facebook-login-render-props";
import { apiConstants } from "../Constant/constants";
import configuration from "react-global-configuration";

import { translate } from "react-multi-lang";
var const_time_zone = Intl.DateTimeFormat().resolvedOptions().timeZone;

class RegisterComponent extends Helper {
  state = {
    data: {
      email: "",
      password: "",
      name: "",
      timezone: const_time_zone,
      referral_code: "",
    },
    loadingContent: null,
    buttonDisable: false,
    check_referral_response: "",
  };

  componentDidMount() {
    const query = new URLSearchParams(this.props.location.search);
    const referral = query.get("referral");
    if (referral) {
      this.setState({ data: { referral_code: referral } });
    }
  }

  handleSubmit = (event) => {
    event.preventDefault();
    const { state } = this.props.location;
    this.setState({
      loadingContent: this.props.t("button_loading"),
      buttonDisable: true,
    });
    api
      .postMethod("v4/register", this.state.data)
      .then((response) => {
        if (response.data.success) {
          localStorage.setItem("userId", response.data.data.user_id);
          localStorage.setItem("accessToken", response.data.data.token);
          localStorage.setItem("userType", response.data.data.user_type);
          localStorage.setItem("push_status", response.data.data.push_status);
          localStorage.setItem("username", response.data.data.name);
          localStorage.setItem(
            "active_profile_id",
            response.data.data.sub_profile_id
          );
          ToastDemo(this.props.toastManager, response.data.message, "success");
          this.props.history.push("/view-profiles");
          this.setState({
            loadingContent: null,
            buttonDisable: false,
          });

          // window.location = state ? state.from.pathname : "/";
        } else {
          ToastDemo(
            this.props.toastManager,
            response.data.error_messages,
            "error"
          );
          this.setState({
            loadingContent: null,
            buttonDisable: false,
          });

          if (response.data.error_code == 3001) {
            setTimeout(function() {
              window.location = "/login";
            }, 3000);
          }
        }
      })
      .catch((error) => {
        this.setState({ loadingContent: null, buttonDisable: false });
        ToastDemo(this.props.toastManager, error, "error");
      });
  };

  responseFacebook = (response) => {
    const { path } = this.props.location;
    if (response) {
      if (response.status == "unknown") {
        ToastDemo(this.props.toastManager, "Cancelled", "error");
        return false;
      }
      const emailAddress =
        response.email === undefined || response.email === null
          ? response.id + "@facebook.com"
          : response.email;

      const facebookLoginInput = {
        social_unique_id: response.id,
        login_by: "facebook",
        email: emailAddress,
        name: response.name,
        device_type: "web",
        device_token: "123466",
        timezone: const_time_zone,
      };
      api
        .postMethod("v4/register", facebookLoginInput)
        .then((response) => {
          if (response.data.success === true) {
            localStorage.setItem("userId", response.data.data.user_id);
            localStorage.setItem("accessToken", response.data.data.token);
            localStorage.setItem("push_status", response.data.data.push_status);
            localStorage.setItem("userType", response.data.data.user_type);

            localStorage.setItem("username", response.data.data.name);
            localStorage.setItem(
              "active_profile_id",
              response.data.data.sub_profile_id
            );
            ToastDemo(
              this.props.toastManager,
              response.data.message,
              "success"
            );
            this.props.history.push("/view-profiles");
            this.setState({
              loadingContent: null,
              buttonDisable: false,
            });
          } else {
            ToastDemo(
              this.props.toastManager,
              response.data.error_messages,
              "error"
            );
            this.setState({
              loadingContent: null,
              buttonDisable: false,
            });
          }
        })
        .catch((error) => {
          ToastDemo(this.props.toastManager, error, "error");
          this.setState({ loadingContent: null, buttonDisable: false });
        });
    }
  };

  responseGoogle = (response) => {
    const path = this.props.location;
    if (response.profileObj) {
      const googleLoginInput = {
        social_unique_id: response.profileObj.googleId,
        login_by: "google",
        email: response.profileObj.email,
        name: response.profileObj.name,
        picture: response.profileObj.imageUrl,
        device_type: "web",
        device_token: "123466",
        timezone: const_time_zone,
      };
      api
        .postMethod("v4/register", googleLoginInput)
        .then((response) => {
          if (response.data.success === true) {
            localStorage.setItem("userId", response.data.data.user_id);
            localStorage.setItem("accessToken", response.data.data.token);
            localStorage.setItem("userType", response.data.data.user_type);
            localStorage.setItem("push_status", response.data.data.push_status);
            localStorage.setItem("username", response.data.data.name);
            localStorage.setItem(
              "active_profile_id",
              response.data.data.sub_profile_id
            );
            ToastDemo(
              this.props.toastManager,
              response.data.message,
              "success"
            );
            this.props.history.push("/view-profiles");
            this.setState({
              loadingContent: null,
              buttonDisable: false,
            });
          } else {
            ToastDemo(
              this.props.toastManager,
              response.data.error_messages,
              "error"
            );
            this.setState({
              loadingContent: null,
              buttonDisable: false,
            });
          }
        })
        .catch((error) => {
          ToastDemo(this.props.toastManager, error, "error");
          this.setState({
            loadingContent: null,
            buttonDisable: false,
          });
        });
    }
  };

  checkReferralCode = (event) => {
    event.preventDefault();

    if (this.state.data.referral_code) {
      let inputData = {
        referral_code: this.state.data.referral_code,
      };
      api
        .postMethod("referral_code_validate", inputData)
        .then((response) => {
          if (response.data.success === true) {
            this.setState({
              loadingContent: null,
              buttonDisable: false,
              check_referral_response: response.data.message,
            });
          } else {
            ToastDemo(
              this.props.toastManager,
              response.data.error_messages,
              "error"
            );

            // this.setState({
            //     check_referral_response: response.data.error
            // });
          }
        })
        .catch((error) => {
          ToastDemo(this.props.toastManager, error, "error");
        });
    }
  };

  render() {
    const { t } = this.props;
    var bgImg = {
      backgroundImage: `url(${configuration.get(
        "configData.common_bg_image"
      )})`,
    };
    const { data } = this.state;
    return (
      <div>
        <div className="common-bg-img" style={bgImg}>
          <div className="auth-page-header">
            <Link to={"/"}>
              <img
                src={configuration.get("configData.site_logo")}
                className="site-logo"
                alt="logo_img"
              />
            </Link>
          </div>

          <div className="row">
            <div className="col-sm-9 col-md-7 col-lg-5 col-xl-4 auto-margin">
              <div className="register-box">
                <h3 className="register-box-head">{t("signup")}</h3>
                <form
                  className="auth-form login-new-form"
                  onSubmit={this.handleSubmit}
                >
                  <div className="form-group">
                    {/*<label htmlFor="name">{t("full_name")}</label>*/}
                    <input
                      onChange={this.handleChange}
                      className="form-control"
                      id="name"
                      name="name"
                      placeholder="Name"
                      value={data.name}
                    />
                  </div>
                  <div className="form-group">
                    {/*<label htmlFor="email">{t("email_address")}</label>*/}
                    <input
                      type="email"
                      onChange={this.handleChange}
                      className="form-control"
                      id="email"
                      name="email"
                      placeholder="Email address"
                      value={data.email}
                    />
                  </div>
                  <div className="form-group">
                    {/*<label htmlFor="pwd">{t("password")}</label>*/}
                    <input
                      type="password"
                      onChange={this.handleChange}
                      className="form-control"
                      id="pwd"
                      name="password"
                      placeholder="Password"
                      value={data.password}
                    />
                  </div>

                  <div className="form-group">
                    {/* <label htmlFor="referral_code">
                      {t("signup_referral_code_label")}
                    </label>*/}
                    <input
                      type="text"
                      onChange={this.handleChange}
                      className="form-control"
                      id="referral_code"
                      name="referral_code"
                      placeholder="Referral Code (Optional)"
                      value={this.state.data.referral_code}
                    />

                    {this.state.data.referral_code ? (
                      <a
                        className="text-warning"
                        href="#"
                        onClick={this.checkReferralCode}
                      >
                        {t("check_referral_code_valid")}

                        {this.state.check_referral_response ? (
                          <p className="text-success">
                            {this.state.check_referral_response}
                          </p>
                        ) : (
                          ""
                        )}
                      </a>
                    ) : (
                      ""
                    )}
                  </div>

                  <button
                    className="btn btn-danger auth-btn"
                    disabled={this.state.buttonDisable}
                  >
                    {this.state.loadingContent != null
                      ? this.state.loadingContent
                      : t("signup")}
                  </button>
                </form>

                <div>
                  {configuration.get("configData.social_logins.FB_CLIENT_ID") ==
                  "" ? (
                    ""
                  ) : (
                    <FacebookLogin
                      appId={configuration.get(
                        "configData.social_logins.FB_CLIENT_ID"
                      )}
                      fields="name,email,picture"
                      scope="public_profile"
                      callback={this.responseFacebook}
                      render={(renderProps) => (
                        <button
                          className="social"
                          onClick={renderProps.onClick}
                          disabled={renderProps.disabled}
                        >
                          <i className="fab fa-facebook fb social-icons" />{" "}
                          {t("login_with")} {t("facebook")}
                        </button>
                      )}
                    />
                  )}
                </div>
                <div>
                  {configuration.get(
                    "configData.social_logins.GOOGLE_CLIENT_ID"
                  ) == "" ? (
                    ""
                  ) : (
                    <GoogleLogin
                      clientId={configuration.get(
                        "configData.social_logins.GOOGLE_CLIENT_ID"
                      )}
                      render={(renderProps) => (
                        <button
                          className="social"
                          onClick={renderProps.onClick}
                          disabled={renderProps.disabled}
                        >
                          <i className="fab fa-google-plus-square google social-icons" />{" "}
                          {t("login_with")} {t("google")}
                        </button>
                      )}
                      buttonText="Login"
                      onSuccess={this.responseGoogle}
                      onFailure={this.responseGoogle}
                      cookiePolicy={"single_host_origin"}
                    />
                  )}
                </div>

                <p className="auth-link">
                  <span className="grey-text">
                    {" "}
                    {t("already_have_account")}{" "}
                  </span>
                  <Link to={"/login"} className="btn-link">
                    {t("sign_in_now")}
                  </Link>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default withToastManager(translate(RegisterComponent));
