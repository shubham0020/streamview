import React from "react";

import { Link } from "react-router-dom";

import api from "../../Environment";
import Helper from "../Helper/helper";
import { withToastManager } from "react-toast-notifications";
import ToastDemo from "../Helper/toaster";

import { translate } from "react-multi-lang";
import configuration from "react-global-configuration";

class ResetPasswordComponent extends Helper {
    state = {
        inputData: {},
        loadingContent: null,
        buttonDisable: false,
    };

    handleChange = ({ currentTarget: input }) => {
        const inputData = { ...this.state.inputData };
        inputData[input.name] = input.value;
        inputData['reset_token'] = this.props.match.params.token;
        this.setState({ inputData });
    };


    handleSubmit = (event) => {
        event.preventDefault();
        const { state } = this.props.location;
        this.setState({
            loadingContent: this.props.t("loading_text"),
            buttonDisable: true,
        });
        api
        .postMethod("reset_password", this.state.inputData)
        .then((response) => {
            if (response.data.success) {
                ToastDemo(this.props.toastManager, response.data.message, "success");
                
                this.setState({
                    loadingContent: null,
                    buttonDisable: false,
                });
                this.props.history.push("/");
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
            this.setState({ loadingContent: null, buttonDisable: false });
            ToastDemo(this.props.toastManager, error, "error");
        });
    };
  render() {
    const { t } = this.props;
    const { inputData } = this.state;
    var bgImg = {
        backgroundImage: `url(${configuration.get(
            "configData.common_bg_image"
        )})`,
    };

    return (
        <div>
            <div className="common-bg-img" style={bgImg}>
                <div className="auth-page-header">
                    <Link to={"/"}>
                    <img
                        src={configuration.get("configData.site_logo")}
                        className="site-logo"
                        alt={configuration.get("configData.site_name")}
                    />
                    </Link>
                </div>

                <div className="row">
                    <div className="col-sm-9 col-md-7 col-lg-5 col-xl-4 auto-margin">
                        <div className="register-box">
                            <h3 className="register-box-head">{t("reset_password")}</h3>
                            <form className="auth-form login-new-form" onSubmit={this.handleSubmit}>
                                <div className="form-group">
                                    <input
                                    type="password"
                                    onChange={this.handleChange}
                                    className="form-control"
                                    id="password"
                                    name="password"
                                    placeholder={t("password")}
                                    value={inputData.password}
                                    />
                                </div>

                                <div className="form-group">
                                    <input
                                    type="password"
                                    onChange={this.handleChange}
                                    className="form-control"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder={t("confirm_password")}
                                    value={inputData.password_confirmation}
                                    />
                                </div>
                                {/* <p className="mt-4 grey-text">{t("forgot_password_text")}</p> */}
                                <button
                                    className="btn btn-danger auth-btn"
                                    disabled={this.state.buttonDisable}
                                >
                                    {this.state.loadingContent != null
                                    ? this.state.loadingContent
                                    : this.props.t("submit")}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
  }
}

export default withToastManager(translate(ResetPasswordComponent));
