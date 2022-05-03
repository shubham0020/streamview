import React from "react"
import ContentLoader from "react-content-loader"

const LandingPageLoader = (props) => (
  <ContentLoader 
    speed={2}
    width={1200}
    height={1400}
    viewBox="0 0 1200 1400"
    backgroundColor="#f3f3f3"
    foregroundColor="#ecebeb"
    opacity="0.2"
    {...props}
  >
    <rect x="9" y="17" rx="0" ry="0" width="1180" height="215" /> 
    <rect x="45" y="318" rx="0" ry="0" width="227" height="15" /> 
    <rect x="46" y="346" rx="0" ry="0" width="290" height="53" /> 
    <rect x="650" y="264" rx="0" ry="0" width="500" height="192" /> 
    <rect x="9" y="235" rx="0" ry="0" width="1180" height="8" /> 
    <rect x="9" y="470" rx="0" ry="0" width="1180" height="8" /> 
    <rect x="46" y="499" rx="0" ry="0" width="500" height="192" /> 
    <rect x="650" y="552" rx="0" ry="0" width="227" height="15" /> 
    <rect x="650" y="580" rx="0" ry="0" width="290" height="53" /> 
    <rect x="9" y="711" rx="0" ry="0" width="1180" height="8" /> 
    <rect x="45" y="789" rx="0" ry="0" width="227" height="15" /> 
    <rect x="46" y="817" rx="0" ry="0" width="290" height="53" /> 
    <rect x="650" y="735" rx="0" ry="0" width="500" height="192" /> 
    <rect x="9" y="941" rx="0" ry="0" width="1180" height="8" /> 
    <rect x="450" y="967" rx="0" ry="0" width="271" height="10" /> 
    <rect x="350" y="999" rx="0" ry="0" width="476" height="38" /> 
    <rect x="350" y="1048" rx="0" ry="0" width="476" height="38" /> 
    <rect x="350" y="1098" rx="0" ry="0" width="476" height="38" /> 
    <rect x="350" y="1148" rx="0" ry="0" width="476" height="38" /> 
    <rect x="350" y="1197" rx="0" ry="0" width="476" height="38" /> 
    <rect x="430" y="1252" rx="0" ry="0" width="315" height="13" /> 
    <rect x="500" y="1275" rx="0" ry="0" width="163" height="34" /> 
    <rect x="9" y="1330" rx="0" ry="0" width="1180" height="53" />
  </ContentLoader>
)

export default LandingPageLoader;