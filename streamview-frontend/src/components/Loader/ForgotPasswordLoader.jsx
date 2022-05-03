import React from "react"
import ContentLoader from "react-content-loader"

const ForgotPasswordLoader = (props) => (
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
    <rect x="9" y="16" rx="0" ry="0" width="148" height="28" /> 
    <rect x="350" y="93" rx="0" ry="0" width="500" height="218" /> 
    <rect x="9" y="360" rx="0" ry="0" width="1180" height="119" />
  </ContentLoader>
)

export default ForgotPasswordLoader;