import React from "react"
import ContentLoader from "react-content-loader"

const InvoiceLoader = (props) => (
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
    <rect x="9" y="17" rx="0" ry="0" width="582" height="49" /> 
    <rect x="147" y="99" rx="0" ry="0" width="302" height="348" /> 
    <rect x="9" y="479" rx="0" ry="0" width="582" height="65" />
  </ContentLoader>
)

export default InvoiceLoader;