import React from "react";
import { LazyLoadImage } from "react-lazy-load-image-component";
import "react-lazy-load-image-component/src/effects/blur.css";

const ImageLoader = ({ image, className, alt }) => {
  return (
    <LazyLoadImage alt={alt} effect="blur" src={image} className={className} />
  );
};

export default ImageLoader;
