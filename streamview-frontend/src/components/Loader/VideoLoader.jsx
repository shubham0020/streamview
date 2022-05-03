import React from "react"
import ContentLoader from "react-content-loader"

const VideoLoader = (props) => (
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
    <rect x="30" y="120" rx="0" ry="0" width="1130" height="407" />
  </ContentLoader>
)

export default VideoLoader;