import React from "react"
import ContentLoader from "react-content-loader"

const ViewProfileLoader = (props) => (
  <ContentLoader 
    speed={2}
    width={1200}
    height={450}
    viewBox="0 0 1200 450"
    backgroundColor="#f3f3f3"
    foregroundColor="#ecebeb"
    opacity="0.2"
    {...props}
  >
    <rect x="9" y="16" rx="0" ry="0" width="200" height="28" /> 
    <rect x="9" y="360" rx="0" ry="0" width="1180" height="119" /> 
    <rect x="380" y="99" rx="0" ry="0" width="500" height="16" /> 
    <rect x="510" y="138" rx="0" ry="0" width="200" height="106" /> 
    <rect x="580" y="251" rx="0" ry="0" width="66" height="13" /> 
    <rect x="430" y="290" rx="0" ry="0" width="370" height="31" />
  </ContentLoader>
)

export default ViewProfileLoader;