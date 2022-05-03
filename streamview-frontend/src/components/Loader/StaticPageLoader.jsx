import React from "react"
import ContentLoader from "react-content-loader"

const StaticPageLoader = (props) => (
  <ContentLoader 
    speed={2}
    width={1200}
    height={700}
    viewBox="0 0 1200 700"
    backgroundColor="#f3f3f3"
    foregroundColor="#ecebeb"
    opacity="0.2"
    {...props}
  >
    <rect x="9" y="18" rx="0" ry="0" width="577" height="53" /> 
    <rect x="9" y="111" rx="0" ry="0" width="75" height="12" /> 
    <rect x="9" y="137" rx="0" ry="0" width="50" height="12" /> 
    <rect x="9" y="161" rx="0" ry="0" width="50" height="12" /> 
    <rect x="9" y="184" rx="0" ry="0" width="70" height="12" /> 
    <rect x="9" y="208" rx="0" ry="0" width="100" height="12" /> 
    <rect x="9" y="230" rx="0" ry="0" width="75" height="12" /> 
    <rect x="146" y="107" rx="0" ry="0" width="113" height="15" /> 
    <rect x="146" y="138" rx="0" ry="0" width="440" height="36" /> 
    <rect x="146" y="196" rx="0" ry="0" width="441" height="8" /> 
    <rect x="146" y="218" rx="0" ry="0" width="288" height="8" /> 
    <rect x="175" y="242" rx="0" ry="0" width="377" height="8" /> 
    <rect x="175" y="266" rx="0" ry="0" width="377" height="8" /> 
    <rect x="175" y="288" rx="0" ry="0" width="377" height="8" /> 
    <rect x="175" y="309" rx="0" ry="0" width="409" height="34" /> 
    <rect x="175" y="353" rx="0" ry="0" width="407" height="31" /> 
    <rect x="176" y="395" rx="0" ry="0" width="377" height="8" /> 
    <rect x="176" y="419" rx="0" ry="0" width="377" height="8" /> 
    <rect x="176" y="441" rx="0" ry="0" width="377" height="8" /> 
    <rect x="176" y="462" rx="0" ry="0" width="409" height="34" /> 
    <rect x="176" y="506" rx="0" ry="0" width="407" height="31" /> 
    <rect x="9" y="578" rx="0" ry="0" width="586" height="65" />
  </ContentLoader>
)

export default StaticPageLoader;