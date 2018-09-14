import React, { Component } from 'react';
import axios from 'axios';
import VideoList from '../widgets/VideoList';
import serverURL from '../../variables';
import ReactPaginate from 'react-paginate';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';

declare var xs;
declare var sm;
declare var md;
declare var lg;

class CategoriesPage extends Component {
    
    state = {
        videos: [],
        category: {},
        pageCount: 1,
        pageNum: 0,
    }

    componentWillMount(){
        this.loadVideos(this.props)
    }

    loadVideos(props) {
        axios.get(`${serverURL}/api/categories/${props.match.params.slug}/videos${this.props.location.search}`)
        .then( response => {
            if (response.data.data.length > 0) {
                this.setState({
                    videos: response.data.data,
                    pageNum: response.data.meta.current_page-1,
                    pageCount: response.data.meta.last_page,
                });
            }
        })
        axios.get(`${serverURL}/api/categories/${props.match.params.slug}`)
        .then( response => {
            this.setState({category:response.data.data});
        })
    }

    componentWillReceiveProps(nextProps) {
        this.loadVideos(nextProps)
    }

    handlePageClick = (data) => {
        let url = '/categories/animation?page=' + (data.selected+1)
        window.location = url;
    };

    displayPaginate = () => {
        return (
            <ReactPaginate 
                pageCount={this.state.pageCount}
                onPageChange={this.handlePageClick}
                forcePage={this.state.pageNum}
                disableInitialCallback={true}
                marginPagesDisplayed={2}
                pageRangeDisplayed={3}
                containerClassName={"pagination"}
                subContainerClassName={"pages pagination"}
                previousLabel={<FontAwesomeIcon icon="caret-left" />}
                previousClassName={"mx-2 p-2"}
                previousLinkClassName={"text-white"}
                nextLabel={<FontAwesomeIcon icon="caret-right" />}
                nextClassName={"mx-2 p-2"}
                nextLinkClassName={"text-white"}
                breakLabel={<a href="">...</a>}
                breakClassName={"mx-5"}
                activeClassName={"btn btn-danger"}
                pageClassName={"btn btn-secondary mx-2"}
                pageLinkClassName={"text-white"}
            />
        )
    }

    render() {
        let size = 2;
        if (xs) {
            size = 12;
        }
        if (sm) {
            size = 6;
        }
        if (md) {
            size = 4;
        }
        if (lg) {
            size = 3;
        }
        return (
            <div className="page-padding">
                <div className="container-fluid">
                    <div className="row">
                        <div className="col section-header">
                            <h1 className="title">{this.state.category.name}</h1>
                        </div>
                    </div>
                    <div className="row d-flex justify-content-center">
                        {this.displayPaginate()}
                    </div>
                    <div className="row">
                        <VideoList videos={this.state.videos} size={size}/>
                    </div>
                    <div className="row d-flex justify-content-center">
                        {this.displayPaginate()}
                    </div>
                </div>
            </div>
        )
    }
};

export default CategoriesPage;