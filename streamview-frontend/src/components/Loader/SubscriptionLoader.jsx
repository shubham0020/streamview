import React from "react"
import ContentLoader from "react-content-loader"

const SubscriptionLoader = (props) => (
  <ContentLoader 
    speed={2}
    width={1200}
    height={1000}
    viewBox="0 0 1200 1000"
    backgroundColor="#f3f3f3"
    foregroundColor="#ecebeb"
    opacity="0.2"
    {...props}
  >
    <rect x="9" y="17" rx="0" ry="0" width="1180" height="45" /> 
    <rect x="18" y="102" rx="0" ry="0" width="350" height="311" /> 
    <rect x="425" y="102" rx="0" ry="0" width="350" height="311" /> 
    <rect x="830" y="102" rx="0" ry="0" width="350" height="311" /> 
    <rect x="18" y="440" rx="0" ry="0" width="350" height="311" /> 
    <rect x="425" y="440" rx="0" ry="0" width="350" height="311" /> 
    <rect x="830" y="440" rx="0" ry="0" width="350" height="311" /> 
    <rect x="9" y="790" rx="0" ry="0" width="1180" height="113" />
  </ContentLoader>
)

export default SubscriptionLoader;