import React, { Component } from 'react';
import axios from 'axios';
import VideoList from '../../../components/widgets/VideoList';
import serverURL from '../../../variables';

export default class ProVideos extends Component {

    state = {
        videos : []
    }

    componentWillMount = () => {
        axios.get(`${serverURL}/api/videos?scope=pro`)
        .then( response => {
            if (response.data.data.length > 0){
                this.setState({videos:response.data.data});
            }
        })
    }

    render() {
        return (
            <div className="page-padding">
                <div className="container">
                    <div className="row">
                        <div className="col section-header text-center">
                            <h1 className="title">Pro Videos</h1>
                            </div>
                    </div>
                    <div className="row">
                        <VideoList videos={this.state.videos} size="3"/>
                    </div>
                </div>
            </div>
        )
    }
}
