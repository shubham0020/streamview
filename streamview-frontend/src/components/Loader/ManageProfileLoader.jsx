import React from "react"
import ContentLoader from "react-content-loader"

const ManageProfileLoader = (props) => (
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
    <rect x="9" y="16" rx="0" ry="0" width="111" height="26" /> 
    <rect x="163" y="121" rx="0" ry="0" width="291" height="15" /> 
    <rect x="181" y="164" rx="0" ry="0" width="141" height="127" /> 
    <rect x="220" y="302" rx="0" ry="0" width="67" height="17" /> 
    <rect x="295" y="334" rx="0" ry="0" width="96" height="31" /> 
    <circle cx="407" cy="253" r="35" /> 
    <rect x="386" y="298" rx="0" ry="0" width="49" height="9" /> 
    <rect x="9" y="417" rx="0" ry="0" width="580" height="100" />
  </ContentLoader>
)

export default ManageProfileLoader;