// External Dependencies
import React, { Component } from 'react';
import Slider from "react-slick";

// Internal Dependencies
import './style.css';

const settings = {
  dots: false,
  arrows: true,
  infinite: false,
  speed: 300,
  slidesToShow: 1,
  slidesToScroll: 1,
  asNavFor: '.robiul_slider_thumb'
}
const settingsThumb = {
  dots: false,
  arrows: false,
  infinite: false,
  speed: 300,
  slidesToShow: 5,
  slidesToScroll: 1,
  asNavFor: '.robiul_slider_carousel_main',
  spaceBetween: 20,
  centeredSlides: true,
  focusOnSelect: true,
  responsive: [
    {
      breakpoint: 1140,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }
  ]
}

class SliderCarousel extends Component {

  static slug = 'robiul_slider_carousel';


  render() {
    //const props = this.props;
    const Content = this.props.content;

    //item.props.attrs.button_text
    //item.props.attrs.button_url
    //item.props.attrs.button_url_new_window
    //item.props.attrs.button_url_new_window
    //item.props.attrs.slider_image
    //item.props.attrs.slider_title
    //item.props.attrs.slider_content

    return (
      <div className='robiul-main-slider'>
        { Content ? (
        <>        
          <div className='robiul_slider_carousel_main'>
            <Slider {...settings}>
              { Content.map( (item, index)=> (
                <div key={index}>
                  <div className='slider-wrapper' style={{ backgroundImage: `url(${item.props.attrs.slider_image})` }}>
                    <div className='slider-inner'>
                      <h2 className='slider-title'>{item.props.attrs.slider_title}</h2>
                      <div className='slider-descriptions'>
                        { <div dangerouslySetInnerHTML={{ __html: item.props.attrs.slider_content }} /> }
                      </div>
                      <a className='slider-buttons' href={item.props.attrs.button_url}>{item.props.attrs.button_text}</a>
                    </div>
                  </div>
                </div>
              ) ) }
            </Slider>
          </div>
          <div className='robiul_slider_thumb'>
            <Slider {...settingsThumb}>
              { Content.map( (item, index)=> (
                <div key={index}>
                  <div className='slider-wrapper' style={{ backgroundImage: `url(${item.props.attrs.slider_image})` }}>
                    <div className='slider-inner'>
                      <img src={item.props.attrs.slider_image} className='slider-thumb' alt={item.props.attrs.slider_title} />
                      <h2 className='slider-title'>{item.props.attrs.slider_title}</h2>
                    </div>
                  </div>
                </div>
              ) ) }
            </Slider>
          </div>
        </>
        ) : (
          <div className='robiul_slider_carousel_main empty-slider'>
            <h2>Add new slider to see carousel content</h2>
          </div>
        ) }
      </div>
    );
  }
}

export default SliderCarousel;
