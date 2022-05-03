import React from "react"
import ContentLoader from "react-content-loader"

const HomeLoader = (props) => (
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
    <rect x="9" y="20" rx="0" ry="0" width="1180" height="55" /> 
    <rect x="9" y="80" rx="0" ry="0" width="1180" height="155" /> 
    <rect x="9" y="260" rx="0" ry="0" width="100" height="9" /> 
    <rect x="9" y="285" rx="0" ry="0" width="280" height="100" /> 
    <rect x="310" y="285" rx="0" ry="0" width="280" height="100" /> 
    <rect x="610" y="285" rx="0" ry="0" width="280" height="100" /> 
    <rect x="908" y="285" rx="0" ry="0" width="280" height="100" /> 
    <rect x="9" y="410" rx="0" ry="0" width="100" height="9" /> 
    <rect x="9" y="440" rx="0" ry="0" width="280" height="100" /> 
    <rect x="310" y="440" rx="0" ry="0" width="280" height="100" /> 
    <rect x="610" y="440" rx="0" ry="0" width="280" height="100" /> 
    <rect x="908" y="440" rx="0" ry="0" width="280" height="100" /> 
    <rect x="9" y="560" rx="0" ry="0" width="100" height="9" /> 
    <rect x="9" y="590" rx="0" ry="0" width="280" height="100" /> 
    <rect x="310" y="590" rx="0" ry="0" width="280" height="100" /> 
    <rect x="610" y="590" rx="0" ry="0" width="280" height="100" /> 
    <rect x="908" y="590" rx="0" ry="0" width="280" height="100" /> 
    <rect x="9" y="710" rx="0" ry="0" width="100" height="9" /> 
    <rect x="9" y="740" rx="0" ry="0" width="280" height="100" /> 
    <rect x="310" y="740" rx="0" ry="0" width="280" height="100" /> 
    <rect x="610" y="740" rx="0" ry="0" width="280" height="100" /> 
    <rect x="908" y="740" rx="0" ry="0" width="280" height="100" /> 
    <rect x="9" y="870" rx="0" ry="0" width="1180" height="65" />
  </ContentLoader>
)

export default HomeLoader;