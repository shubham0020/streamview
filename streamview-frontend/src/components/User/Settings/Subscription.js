import React, { Component } from "react";
import { Link } from "react-router-dom";
import api from "../../../Environment";
import { t } from "react-multi-lang";
import SubscriptionLoader from "../../Loader/SubscriptionLoader";
import Helper from "../../Helper/helper";

class SubscriptionComponent extends Helper {
  state = {
    subscriptions: [],
    loading: true,
  };
  componentDidMount() {
    // api call
    const data = {
      sub_profile_id: "",
    };

    api.postMethod("subscription_plans", data).then((response) => {
      if (response.data.success === true) {
        let subscriptions = response.data.data;
        this.setState({ loading: false, subscriptions: subscriptions });
      } else {
        this.errorCodeChecker(response.data.error_code);
      }
    });
  }

  renderSubscription = (subscriptions) => {
    return (
      <React.Fragment>
        {subscriptions.map((subscription) => (
          <div
            className="col-sm-12 col-md-6 col-lg-4 col-xl-4"
            key={subscription.subscription_id}
          >
            <div className="subcsription-card">
              <div className="subcsription-head">{subscription.title}</div>
              <div
                className={
                  "subcsription-price" +
                  (subscription.popular_status == 1 ? " premium" : "")
                }
              >
                <p>{t("plan")}</p>
                <h4>
                  {subscription.currency}
                  {subscription.amount} / {subscription.plan_formatted}
                </h4>
              </div>
              <div className="subcsription-details">
                <h4>{t("maintain_account")}</h4>
                <h5>
                  <i className="fas fa-user-plus" />
                  {subscription.no_of_account}
                </h5>
                <p>{subscription.description}</p>
                <div className="text-right mt-4">
                  <Link
                    to={{
                      pathname: "/invoice",
                      state: {
                        subscription: subscription,
                      },
                    }}
                    className="btn btn-danger"
                  >
                    {t("pay_now")}
                  </Link>
                </div>
              </div>
            </div>
          </div>
        ))}
      </React.Fragment>
    );
  };
  render() {
    const { loading, subscriptions } = this.state;
    return (
      <div>
        <div className="main padding-top-md">
          {loading ? (
            <SubscriptionLoader />
          ) : (
            <div className="top-bottom-spacing">
              <div className="row">
                <div className="col-sm-10 col-md-10 col-lg-11 col-xl-10 auto-margin">
                  <div className="row resp-content-center">
                    {loading
                      ? t("loading")
                      : this.renderSubscription(subscriptions)}
                  </div>
                </div>
              </div>
            </div>
          )}
        </div>
      </div>
    );
  }
}

export default SubscriptionComponent;
