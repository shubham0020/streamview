import React from "react";
import PaypalExpressBtn from "react-paypal-express-checkout";

import { Link  } from "react-router-dom";
import ContentLoader from "../../Static/contentLoader";
import Helper from "../../Helper/helper";
import api from "../../../Environment";
import { withToastManager } from "react-toast-notifications";
import ToastDemo from "../../Helper/toaster";

import QRCode from "react-qr-code";
import { translate, t } from "react-multi-lang";
import configuration from "react-global-configuration";

class InvoiceComponent extends Helper {
 
    state = {
        loading: true,
        data: {},
        promoCode: null,
        loadingPromoCode: true,
        paymentMode: "card",
        loadingContent: null,
        buttonDisable: false,
        loadingContentCard: null,
        buttonDisableCard: false,
        freeSubscription: false,
        referralData: null,
        loadingReferral: true,
        pay_amount: 0,
        qrCode:'',
        transaction_ID:'',
        date:null,
       userNameData:null,
       useDetails:{},
       radio:null
    };
    getUserDetails() {
        api.postMethod("profile").then((response) => {
          if (response.data.success === true) {
            var data = response.data.data;
            this.setState({ loading: false, useDetails: data });
            console.log(this.state.useDetails,'useid')
           
          }
        });
      }
     
    componentDidMount() {
        api.getMethod("storeUsers").then((response) => {
            if (response.data.success === true) {
              var data = response.data.data;
              this.setState({ loading: false, data: data });
              this.setState({userNameData:data})
             console.log(this.state.userNameData,'usernameData')
            }
          });
            
        this.getUserDetails();
        if (this.props.location.state) {
            this.setState({ loading: false });
        } else {
            window.location = "/subscription";
        }

        this.checkReferralInvoice();

        this.setState({
            pay_amount: this.props.location.state.subscription.amount
            
        });
    }

    checkReferralInvoice = event => {
        let inputData = {
            amount: this.props.location.state.subscription.amount
        };
        api.postMethod("invoice_referral_amount", inputData)
            .then(response => {
                if (response.data.success) {
                    if (response.data.data.pay_amount <= 0) {
                        // Hide promocode section
                        // Enable subscribe now button
                        this.setState({
                            freeSubscription: true
                        });
                    }

                    this.setState({
                        referralData: response.data.data,
                        pay_amount: response.data.data.pay_amount,
                        loadingReferral: false
                    });
                } else {
                    ToastDemo(
                        this.props.toastManager,
                        response.data.error_messages,
                        "error"
                    );
                    this.setState({
                        loadingContent: null,
                        buttonDisable: false
                    });
                }
            })
            .catch(error => {
                // ToastDemo(this.props.toastManager, error, "error");
                // this.setState({ loadingContent: null, buttonDisable: false });
            });
    };

    handlePromoCode = event => {
        event.preventDefault();
        this.setState({
            loadingContent: t("loading_text"),
            buttonDisable: true
        });
        let inputData = {
            coupon_code: this.state.data.coupon_code,

            subscription_id: this.props.location.state.subscription
                .subscription_id
        };
        api.postMethod("apply/coupon/subscription", inputData)
            .then(response => {
                if (response.data.success) {
                    ToastDemo(
                        this.props.toastManager,
                        t("promo_code_applied_success"),
                        "success"
                    );
                    this.setState({
                        loadingContent: null,
                        buttonDisable: false,
                        loadingPromoCode: false,
                        promoCode: response.data.data
                    });
                    if (response.data.data.remaining_amount <= 0) {
                        this.setState({
                            freeSubscription: true
                        });
                    } else {
                        this.setState({
                            freeSubscription: false
                        });
                    }
                    this.setState({
                        loadingContent: null,
                        buttonDisable: false,
                        pay_amount: response.data.data.remaining_amount
                    });
                } else {
                    ToastDemo(
                        this.props.toastManager,
                        response.data.error_messages,
                        "error"
                    );
                    this.setState({
                        loadingContent: null,
                        buttonDisable: false
                    });
                }
            })
            .catch(error => {
                ToastDemo(this.props.toastManager, error, "error");
                this.setState({ loadingContent: null, buttonDisable: false });
            });
    };

    handlePromoCodeCancel = event => {
        event.preventDefault();
        this.setState({ promoCode: null, loadingPromoCode: true });
        ToastDemo(this.props.toastManager, t("promo_code_removed"), "error");
    };
    
    handleChange = e => {
        const { name, value } = e.target;
    
        this.setState({
          [name]: value
        });
      };

    handleChangePayment = (e) => {
        this.setState({ paymentMode: e.target.value })
    };

    handlePayment = event => {
        let transactionID = Math.floor(Math.random() * 1000000000000000);
        this.setState({transaction_ID:transactionID})
        event.preventDefault();
        let inputsData = {
            userEmail : this.state.data.email,
            amount: this.state.pay_amount,
            subscription_id: this.props.location.state.subscription
                .subscription_id
        };
        if(this.state.paymentMode=="COD"){
            this.setState
            ({qrCode: `http://api.qrserver.com/v1/create-qr-code/?&size=10*10&data= userEmail:${this.state.data.email} amount:${this.state.pay_amount} subId: ${this.props.location.state.subscription
            .subscription_id} TransID: ${this.state.transaction_ID} paymentMode: ${this.state.paymentMode}`})
            let image =`http://api.qrserver.com/v1/create-qr-code/?data=${this.state.data.email} ${this.state.pay_amount} ${this.props.location.state.subscription
            .subscription_id}.png`
              
        } else if(this.state.paymentMode=='card'){
            this.setState({
                loadingContentCard: t("loading_text"),
                buttonDisableCard: true
            });
            let inputData;
            if (this.state.promoCode == null) {
                inputData = {
                    subscription_id: this.props.location.state.subscription
                        .subscription_id,
                    payment_mode: this.state.paymentMode ,
                };
            } else {
                inputData = {
                    coupon_code: this.state.data.coupon_code,
    
                    subscription_id: this.props.location.state.subscription
                        .subscription_id,
                    payment_mode: this.state.paymentMode,
                };
            }
            this.paymentApiCall(inputData);
        };
        }
       

    paymentApiCall = inputData => {
        api.postMethod("v4/subscriptions_payment", inputData)
            .then(response => {
                if (response.data.success) {
                    ToastDemo(
                        this.props.toastManager,
                        response.data.message,
                        "success"
                    );
                    this.setState({
                        loadingContentCard: null,
                        buttonDisableCard: false
                    });
                    this.setState({
                        loadingContentCard: null,
                        buttonDisableCard: false
                    });
                    this.props.history.push("/billing-details");
                } else {
                    ToastDemo(
                        this.props.toastManager,
                        response.data.error_messages,
                        "error"
                    );
                    this.setState({
                        loadingContentCard: null,
                        buttonDisableCard: false
                    });
                }
            })
            .catch(error => {
                ToastDemo(this.props.toastManager, error, "error");
                this.setState({
                    loadingContentCard: null,
                    buttonDisableCard: false
                });
            });
    };
    sendDetails=()=>{
        api.getMethod(`email/qrcode?email=${this.state.useDetails.email}&qrcode=http://api.qrserver.com/v1/create-qr-code/?&size=10*10&data= userEmail:${this.state.useDetails.email} amount:${this.state.pay_amount} TransID: ${this.state.transaction_ID} paymentMode: ${this.state.paymentMode}`).then(response => {  

            if (response.data.success) {
                this.setState({
                email: true
                    });
                }
          })
          .catch(error => {
            // error
          });

        api.getMethod(`subscription?subscription_id=${this.props.location.state.subscription
            .subscription_id}&expiry=${new Date().getFullYear() + '-' + (new Date().getMonth() + 1) + '-' +( new Date().getDate()+1) + ' ' +( new Date().toLocaleTimeString())}&transactionID=${this.state.transaction_ID}&payment_mode= ${this.state.paymentMode}&amount=${this.state.pay_amount}&userid=${this.state.useDetails.id}&storeid=${this.state.radio}`).then(response => {
                
            if (response.data.success) {
                if (response.data.data.pay_amount <= 0) {
                    // Hide promocode section
                    // Enable subscribe now button
                    this.setState({
                        freeSubscription: true
                    });
                }

                this.setState({
                    referralData: response.data.data,
                    pay_amount: response.data.data.pay_amount,
                    loadingReferral: false
                });
            } else {
                ToastDemo(
                    this.props.toastManager,
                    response.data.error_messages,
                    "error"
                );
                this.setState({
                    loadingContent: null,
                    buttonDisable: false
                });
            }
        })
        .catch(error => {
            // ToastDemo(this.props.toastManager, error, "error");
            // this.setState({ loadingContent: null, buttonDisable: false });
        });
        
    }
 
    render() {
     console.log(this.state.paymentMode,'daaaaaaaaaaaaaaaaaa')
        let qrcodeData ={
            userName: this.state.data.name,
            userEmail: this.state.data.email,
            id:this.state.pay_amount
        }
       
        const { t } = this.props;
        if (this.state.loading) {
            return <ContentLoader />;
        } else {
            var invoiceImg = {
                backgroundImage: "url(../assets/img/invoice.gif)"
            };
            const { subscription } = this.props.location.state;
            const {
                data,
                loadingPromoCode,
                promoCode,
                paymentMode,
            } = this.state;

            const onSuccess = payment => {
                console.log("Success");
                // Congratulation, it came here means everything's fine!

                let inputData;
                if (this.state.promoCode == null) {
                    inputData = {
                        subscription_id: this.props.location.state.subscription
                            .subscription_id,
                        payment_mode: this.state.paymentMode ,
                        payment_id: payment.paymentID
                    };
                } else {
                    inputData = {
                        coupon_code: this.state.data.coupon_code,

                        subscription_id: this.props.location.state.subscription
                            .subscription_id,
                        payment_mode: this.state.paymentMode ,
                        payment_id: payment.paymentID
                    };
                }
                this.paymentApiCall(inputData);

                // You can bind the "payment" object's value to your state or props or whatever here, please see below for sample returned data
            };

            const onCancel = data => {
                console.log("ERROR");
                // User pressed "cancel" or close Paypal's popup!
                // You can bind the "data" object's value to your state or props or whatever here, please see below for sample returned data
            };

            const onError = err => {
                console.log("ERROR");
                // The main Paypal's script cannot be loaded or somethings block the loading of that script!
                // Because the Paypal's main script is loaded asynchronously from "https://www.paypalobjects.com/api/checkout.js"
                // => sometimes it may take about 0.5 second for everything to get set, or for the button to appear
            };

            let env = configuration.get("configData.PAYPAL_MODE"); // you can set here to 'production' for production
            let currency = "USD"; // or you can set this value from your props or state
            let total = loadingPromoCode
                ? subscription.amount
                : promoCode.remaining_amount; // same as above, this is the total amount (based on currency) to be paid by using Paypal express checkout

            const client = {
                sandbox: configuration.get("configData.PAYPAL_ID"),
                production: configuration.get("configData.PAYPAL_ID")
            };
         
            const today = new Date(),

 date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' +( today.getDate()+1) + ' ' +( today.toLocaleTimeString());

const name = "Flash";

            return (
                <div>

<div className="modal fade mt-5" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div className="modal-dialog " role="document">
    <div style={{width:'160%'}}  className=" modal-content p-4 ">
      <div className="modal-header col-md-12">
          <h3  className="text-dark color-primary modal-title" id="exampleModalLabel">Waknes Paywel</h3>
       
        <button type="button" className="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div className="modal-body col-md-12">
        <div className="text-center text-dark "><p>Plaese pay withnin 24 hours Expiration date: {date}</p></div>
      <div className="output-box d-flex flex-wrap border ">
          <div className="col-md-6 p-5">
              <p className="text-dark" >Name : {this.state.useDetails.name}</p>
              <p className="text-dark">Email : {this.state.useDetails.email}</p>
              <p className="text-dark">Transiction Id : {this.state.transaction_ID}</p>
              <p className="text-dark">Amount : ${this.state.pay_amount}</p>
              <p className="text-dark">Amount-NAFL : ${this.state.pay_amount}</p>
          </div>
       <div className="col-md-6 p-5" >
       <img  src={this.state.qrCode} alt=""  id="qrcodeImage"  />
        <a href={this.state.qrCode} download="QRCode">
        </a>
       </div>
      </div>

        <div className="col-md-12 border my-3">
              <div className="col-md-6 py-2">
                <p className="text-dark">Store to a Paid</p>
              </div>
              <div>
                <form>
                 <div style={{ height:'80px', overflowY:'scroll'}} className="d-flex flex-wrap  ">
                    <div className="form-check col-md-3 p-2 ">
                   {
                       this.state.userNameData && this.state.userNameData.map((item)=>{
                        return (
                            <>
                            <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios"
                         onChange={(e)=>this.setState({radio: e.target.value})} id={item.name} value={item.id} />
                        <label class="form-check-label" for={item.name}>
                      {item.name}
                        </label>
                      </div>
                            </>
                        )
                       })
                   }
                    </div>
                
                 </div>
                </form>
              </div>
        </div>

        <div style={{fontSize:'13px'}} className="col-md-12 border my-3 text-dark p-4">
            <h6>Payment process</h6>
         <div style={{lineHeight:'2px'}} className="py-3 container">
              <p>1. bring this document to the store</p>
            <p>2. Submit this document to the staff to scan the QR code</p>
            <p>3. Make payment for the service according to the amount indicated in this document</p>
         </div>
        </div>
        
      </div>
      <div className="modal-footer">
        <input type="hidden" name="email" value={this.state.data.email}/>
        <button onClick={this.sendDetails} type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
        Send To Store
        </button>
      </div>
    </div>
  </div>
</div>


                    <div className="main padding-top-md">
                        <div className="top-bottom-spacing">
                            <div className="row">
                                <div className="col-sm-10 col-md-8 col-lg-7 col-xl-6 auto-margin">
                                    <div
                                        style={invoiceImg}
                                        className="invoice-img"
                                    >
                                        <h1>{t("invoice")}</h1>
                                    </div>
                                    <div className="payment-option">
                                        <h4 className="billing-head">
                                            <i className="far fa-file mr-2" />
                                            {subscription.title}
                                        </h4>
                                        <p className="grey-line" />
                                        <div className="">
                                            <p className="grey-clr pay-perview-text">
                                                {subscription.description}
                                            </p>
                                            <h5 className="">
                                                {t("no_of_accounts")} -{" "}
                                                {subscription.no_of_account}
                                            </h5>
                                        </div>
                                        {/* <!-- table1 --> */}
                                        <div className="table-responsive">
                                            <table className="table white-bg m-0 mt-3">
                                                <tbody>
                                                    <tr className="table-secondary">
                                                        <td>{t("amount")}</td>
                                                        <td>
                                                            {
                                                                subscription.currency
                                                            }
                                                            {
                                                                subscription.amount
                                                            }
                                                        </td>
                                                    </tr>
                                                    {subscription.amount > 0 ? (
                                                        <tr>
                                                            <td>
                                                                {t(
                                                                    "promo_code_amount"
                                                                )}
                                                            </td>
                                                            <td>
                                                                {
                                                                    subscription.currency
                                                                }
                                                                {loadingPromoCode
                                                                    ? "0"
                                                                    : promoCode.coupon_amount}
                                                            </td>
                                                        </tr>
                                                    ) : (
                                                        ""
                                                    )}
                                                    {!this.state
                                                        .loadingReferral ? (
                                                        this.state.referralData
                                                            .referral_amount >
                                                        0 ? (
                                                            <tr>
                                                                <td>
                                                                    {t(
                                                                        "referral_amount_applied"
                                                                    )}
                                                                </td>
                                                                <td>
                                                                    {
                                                                        this
                                                                            .state
                                                                            .referralData
                                                                            .referral_amount_formatted
                                                                    }
                                                                </td>
                                                            </tr>
                                                        ) : (
                                                            ""
                                                        )
                                                    ) : (
                                                        ""
                                                    )}
                                                    <tr className="table-secondary">
                                                        <td>{t("total")}</td>
                                                        <td>
                                                            {
                                                                subscription.currency
                                                            }
                                                            {
                                                                this.state
                                                                    .pay_amount
                                                            }
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        {/* <!-- table --> */}

                                        {/* <!-- coupon --> */}
                                        {subscription.amount > 0 &&
                                        !this.state.freeSubscription ? (
                                            <div className="mt-4">
                                                <h5 className="capitalize">
                                                    {t("have_a_coupon")}
                                                </h5>
                                                <form
                                                    className="auth-form"
                                                    onSubmit={
                                                        this.handlePromoCode
                                                    }
                                                >
                                                    <div className="form-group mt-3">
                                                        <div className="input-group mb-3 mt-1">
                                                            <input
                                                                type="text"
                                                                className="form-control m-0 mb-0"
                                                                placeholder="promo code"
                                                                name="coupon_code"
                                                                value={
                                                                    data.coupon_code
                                                                }
                                                                onChange={
                                                                    this
                                                                        .handleChange
                                                                }
                                                            />
                                                            <div className="input-group-append">
                                                                <button
                                                                    className="btn btn-danger"
                                                                    type="submit"
                                                                >
                                                                    {this.state
                                                                        .loadingContent !=
                                                                    null
                                                                        ? this
                                                                              .state
                                                                              .loadingContent
                                                                        : t(
                                                                              "send"
                                                                          )}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                {loadingPromoCode ? (
                                                    ""
                                                ) : (
                                                    <p className="capitalize">
                                                        {t(
                                                            "promo_code_applied"
                                                        )}{" "}
                                                        -{" "}
                                                        {promoCode.coupon_code}{" "}
                                                        for{" "}
                                                        {
                                                            promoCode.original_coupon_amount
                                                        }{" "}
                                                        -{" "}
                                                        <Link
                                                            to="#"
                                                            className="btn btn-outline-danger"
                                                            onClick={
                                                                this
                                                                    .handlePromoCodeCancel
                                                            }
                                                        >
                                                            {t("remove")}
                                                        </Link>
                                                    </p>
                                                )}
                                            </div>
                                        ) : (
                                            ""
                                        )}
                                        {/* <!-- coupon --> */}









                                        {/* <!-- payment option --> */}

                                        <div className="mt-4">
                                            <form className="mt-3" 
                                            value={this.state.paymentMode}
                                            onChange={ this.handleChangePayment} >
                                                {subscription.amount > 0 &&
                                                this.state.freeSubscription ==
                                                    false ? (
                                                    <div>
                                                        <h5 className="capitalize">{t( "choose_payment_option" )} </h5> 
                                                        {configuration.get("configData.PAYPAL_ID") ? 
                                                        (<div className="form-check-inline">
                                                                <input
                                                                    type="radio"
                                                                    id="paypal"
                                                                    name="payment_mode"
                                                                    value="paypal"
                                                                    
                                                                    />
                                                                <label htmlFor="paypal">
                                                                    {t("paypal" )}
                                                                </label>
                                                            </div>
                                                            ) : ( "" )}
                                                        <div className="form-check-inline">
                                                            <input
                                                                type="radio"
                                                                id="card"
                                                                name="payment_mode"
                                                                value="card"
                                                                defaultChecked={true}
                                                               />
                                                            <label htmlFor="card">
                                                                {t( "card_payment" )}
                                                            </label>
                                                        </div>
                                                     
                                                        <div className="form-check-inline">
                                                            <input
                                                                type="radio"
                                                                id="COD"
                                                                name="payment_mode"
                                                                value="COD"
                                                                onChange={this.handleChange}
                                                                
                                                            />
                                                            <label htmlFor="COD">
                                                                {t( "COD" )}
                                                            </label>
                                                        </div>
                                                        <Link
                                                            to="/add-card"
                                                            className="float-right btn-link" >
                                                            {t("add")}{" "}
                                                            {t("card")}{" "}
                                                            {t("COD")}
                                                        </Link>
                                                    </div>
                                                ) : (
                                                    ""
                                                )}

                                                <div className="text-right mb-3 mt-3">
                                                    {paymentMode && paymentMode == "card" ||paymentMode=="COD" ? (
                                                        <button
                                                            className="btn btn-danger "
                                                          data-toggle={paymentMode=="COD" ?  "modal" : ""}
                                                          data-target={paymentMode=="COD" ?  "#exampleModal" : ""}
                                                            onClick={ this .handlePayment}
                                                            disabled={ this.state .buttonDisableCard }
                                                        >
                                                            {this.state.freeSubscription ==false
                                                                ? this.state.loadingContentCard != null
                                                                    ? this.state.loadingContentCard
                                                                    : subscription.amount > 0
                                                                    ? t( "pay_now")
                                                                    : t("subscribe_now" )
                                                                : t("subscribe_now")}
                                                        </button>
                                                    ) : (
                                                        <PaypalExpressBtn
                                                            env={env}
                                                            client={client}
                                                            currency={currency}
                                                            total={total}
                                                            onError={onError}
                                                            onSuccess={
                                                                onSuccess
                                                            }
                                                            onCancel={onCancel}
                                                        />
                                                    )}
                                                                                                            </div>



                                            </form>
                                        </div>

                                        {/* <!-- payment option --> */}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            );
        }
    }
}

export default withToastManager(translate(InvoiceComponent));
