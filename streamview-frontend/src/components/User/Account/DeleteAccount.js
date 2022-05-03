import React from "react";
import api from "../../../Environment";
import { withToastManager } from "react-toast-notifications";

import { translate } from "react-multi-lang";

import configuration from "react-global-configuration";
import ToastDemo from "../../Helper/toaster";
import Helper from "../../Helper/helper";

class DeleteAccountComponent extends Helper {
    state = {
        data: {}
    };

    handleDelete = event => {
        event.preventDefault();
        api.postMethod("deleteAccount", this.state.data).then(response => {
            if (response.data.success === true) {
                ToastDemo(
                    this.props.toastManager,
                    response.data.message,
                    "success"
                );
                this.props.history.push("/logout");
            } else {
                ToastDemo(
                    this.props.toastManager,
                    response.data.error_messages,
                    "error"
                );
            }
        });
    };
    render() {
        const { t } = this.props;

        var bgImg = {
            backgroundImage: `url(${configuration.get(
                "configData.common_bg_image"
            )})`
        };
        return (
            <div className="edit-profile-sec-1">
                <div className="common-bg-img" style={bgImg}>
                    <div className="main padding-top-md">
                        <div className="row">
                            <div className="col-sm-9 col-md-7 col-lg-5 col-xl-4 auto-margin">
                                <div className="register-box resp-margin-left-right-xs">
                                    <h3 className="register-box-head">
                                        {t("delete")} {t("account")}
                                    </h3>
                                    <form
                                        onSubmit={this.handleDelete}
                                        className="auth-form"
                                        action=""
                                    >
                                        <p className="note">
                                            <b>{t("note")}:</b>{" "}
                                            {t("delete_account_note")}
                                        </p>
                                        <div className="form-group">
                                            <input
                                                type="password"
                                                className="form-control"
                                                placeholder="enter password"
                                                name="password"
                                                value={this.state.data.password}
                                                onChange={this.handleChange}
                                            />
                                        </div>
                                        <button className="btn btn-danger auth-btn mt-4">
                                            {t("delete_account")}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
export default withToastManager(translate(DeleteAccountComponent));
