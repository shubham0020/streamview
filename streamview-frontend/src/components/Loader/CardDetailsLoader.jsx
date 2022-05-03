import React from "react"
import ContentLoader from "react-content-loader"

const CardDetailsLoader = (props) => (
  <ContentLoader 
    speed={2}
    width={1200}
    height={600}
    viewBox="0 0 1200 600"
    backgroundColor="#f3f3f3"
    foregroundColor="#ecebeb"
    opacity="0.2"
    {...props}
  >
    <rect x="9" y="17" rx="0" ry="0" width="1180" height="49" /> 
    <rect x="220" y="99" rx="0" ry="0" width="750" height="348" /> 
    <rect x="9" y="479" rx="0" ry="0" width="1180" height="65" />
  </ContentLoader>
)

export default CardDetailsLoader;
