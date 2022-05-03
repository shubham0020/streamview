import React, { Component } from "react";
import api from "../../Environment";
import renderHTML from "react-render-html";
import { t } from "react-multi-lang";

class Page extends Component {
  state = {
    data: {},
    loading: true
  };

  componentDidMount() {
    this.singlePageAPICall(this.props.match.params.id);
  }

  singlePageAPICall = unique_id => {
    api.getMethod("pages/list?unique_id" + "=" + unique_id).then(response => {
      if (response.data.success === true) {
        this.setState({
          loading: false,
          data: response.data.data
        });
      }
    });
  };

  //WARNING! To be deprecated in React v17. Use new lifecycle static getDerivedStateFromProps instead.
  componentWillReceiveProps(nextProps) {
    this.setState({ loading: true });
    this.singlePageAPICall(nextProps.location.state.unique_id);
  }

  render() {
    const { loading, data } = this.state;

    return (
      <div className="top-bottom-spacing">
        <div className="">
          <div className="static-head">
            <h1>{loading ? t("loading") : data.title}</h1>
          </div>
          <div className="static-content">
            {loading ? t("loading") : renderHTML(data.description)}
          </div>
        </div>
      </div>
    );
  }
}

export default Page;