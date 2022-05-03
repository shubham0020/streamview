import React from "react"
import ContentLoader from "react-content-loader"

const AccountLoader = (props) => (
  <ContentLoader 
    speed={2}
    width={1200}
    height={500}
    viewBox="0 0 1200 500"
    backgroundColor="#f3f3f3"
    foregroundColor="#ecebeb"
    opacity="0.2"
    {...props}
  >
    <rect x="9" y="21" rx="0" ry="0" width="193" height="10" /> 
    <rect x="9" y="57" rx="0" ry="0" width="200" height="7" /> 
    <rect x="500" y="57" rx="0" ry="0" width="200" height="8" /> 
    <rect x="500" y="75" rx="0" ry="0" width="200" height="8" /> 
    <rect x="988" y="55" rx="0" ry="0" width="200" height="8" /> 
    <rect x="938" y="69" rx="0" ry="0" width="250" height="11" /> 
    <rect x="958" y="87" rx="0" ry="0" width="230" height="10" /> 
    <rect x="9" y="38" rx="0" ry="0" width="1180" height="5" /> 
    <rect x="9" y="109" rx="0" ry="0" width="1180" height="5" /> 
    <rect x="9" y="140" rx="0" ry="0" width="200" height="7" /> 
    <rect x="500" y="140" rx="0" ry="0" width="200" height="8" /> 
    <rect x="1078" y="138" rx="0" ry="0" width="110" height="8" /> 
    <rect x="1054" y="152" rx="0" ry="0" width="134" height="11" /> 
    <rect x="9" y="182" rx="0" ry="0" width="1180" height="5" /> 
    <rect x="9" y="210" rx="0" ry="0" width="200" height="7" /> 
    <rect x="1078" y="208" rx="0" ry="0" width="110" height="8" /> 
    <circle cx="500" cy="218" r="16" /> 
    <rect x="530" y="214" rx="0" ry="0" width="150" height="8" /> 
    <rect x="9" y="251" rx="0" ry="0" width="1180" height="5" /> 
    <rect x="9" y="281" rx="0" ry="0" width="200" height="7" /> 
    <rect x="500" y="281" rx="0" ry="0" width="147" height="8" /> 
    <rect x="1078" y="279" rx="0" ry="0" width="110" height="8" /> 
    <rect x="1054" y="293" rx="0" ry="0" width="134" height="11" /> 
    <rect x="9" y="323" rx="0" ry="0" width="1180" height="5" />
  </ContentLoader>
)

export default AccountLoader;