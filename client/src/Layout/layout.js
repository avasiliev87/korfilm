import React from 'react';
import { withRouter } from 'react-router-dom';
import { connect } from 'react-redux';
import ReactLoading from 'react-loading';
import Header from './Header';
import Footer from './Footer';
import SearchPage from './SearchPage';
import LeftSidebar from './LeftSidebar';
import 'bootstrap/scss/bootstrap.scss';
import '../scss/layout.scss';

import { library } from '@fortawesome/fontawesome-svg-core';
import { faSearch, faHome, faFilm, faTh, faEdit, faMagic, faUser, faEnvelope, 
         faAngleUp, faAngleDown, faPlayCircle, faAngleLeft, faAngleRight, faThList, faThLarge,
         faClock, faEye, faPlay, faVideo, faHeart, faStar, faCalendar, faBurn, faThumbsUp, faSignature,
         faHistory, faLandmark, faCarCrash, faTimes, faCalendarCheck } from '@fortawesome/free-solid-svg-icons';
import { faTwitter, faGooglePlus, faInstagram, faVimeo, faFacebookF, 
         faFacebook, faYoutube, faFlickr } from '@fortawesome/free-brands-svg-icons';

library.add(faTwitter, faGooglePlus, faInstagram, faVimeo, faFacebookF, faYoutube, 
    faSearch, faHome, faFilm, faTh, faEdit, faMagic, faUser, faEnvelope, faAngleUp, faAngleDown,
    faPlayCircle, faAngleLeft, faAngleRight, faThList, faThLarge, faClock, faEye, faPlay, faFacebook, faVideo, faFlickr, faHeart, 
    faStar, faCalendar, faBurn, faThumbsUp, faSignature, faHistory, faLandmark, faCarCrash, faTimes, faCalendarCheck);
    
const Layout = (props) => {

    const mainContent = () => {
        if (props.login.user != null) {
            let paddingLeft = '6.9rem'
            if (props.sidebar.toggleSidebar){
                paddingLeft = '24rem'
            }
            return (
                <div className="page" style={ {
                    paddingLeft: paddingLeft, 
                    transition: 'padding 0.5s'
                    } }
                >
                    {props.children}
                </div>
            )
        }
        else {
            return (
                <div className="page" style={{
                    transition: 'padding 0.5s'
                }}>
                    {props.children}
                </div>
            )
        }
    }
    return(
        <div>
            {   !props.banner.bannerLoad && 
                <div className="loading-page">
                    <ReactLoading className="loading" type={'spinningBubbles'} color={'white'} height={40} width={40} />
                </div>
            }
            {   props.banner.bannerLoad &&
                <div>
                    <Header/>
                    <SearchPage/>
                    { props.login.user != null && <LeftSidebar/> }
                    { mainContent() }
                    <Footer/>
                </div>
            }
        </div>
    )
}

const mapStateToProps = (state) => {
    return {
      login: state.login,
      sidebar: state.sidebar,
      banner: state.banner
    }
}

  
export default withRouter( connect(mapStateToProps, null)(Layout));