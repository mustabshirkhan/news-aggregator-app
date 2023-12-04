import React, {useState, useEffect, useMemo} from 'react';
import axios from 'axios';
import {Container, Row, Col, Card} from 'react-bootstrap';

import Filters from "../Filters/filters";
import {
    MDBContainer,
    MDBRow,
    MDBCol
} from 'mdb-react-ui-kit';
import 'bootstrap/dist/css/bootstrap.min.css';
import Select from 'react-select';
import usePreferences from "../../hooks/usePreferences";
import useAuth from "../../hooks/useAuth";
import useFilters from "../../hooks/useFilters";
import useNewsAggregator from "../../hooks/useNewsAggregator";
import NewsCard from "./Card/newsCard";
const NewsAggregator = () => {

    const {http, token} = useAuth();
    const {
        authors,
        categories,
        userPreferences
    } = usePreferences({http, token});
    const {
        news,
        setNews,
        searchBarComponent
    } = useNewsAggregator({token,http,userPreferences})

    const {
        authorFilter,categoryFilter,publishedDate,
        setCategoryFilter,setAuthorFilter,setpublishedDate,
        handleCategoryFilterChange,handlePublishedDateChange,handleAuthorFilterChange,
        handleFilterButton:handleFilter
    } =  useFilters({
        token, http, setNews
    })

    const [cancelToken, setCancelToken] = useState(null);



    useEffect(() => {
        if (token && userPreferences) {
            // Set initial state based on user preferences
            setAuthorFilter(
                userPreferences?.preferred_authors?.map((author) => ({
                label: author.name,
                value: author.name,
            })) || []);

            setCategoryFilter(
                userPreferences?.preferred_categories?.map((category) => ({
                label: category.name,
                value: category.name,
            })) || []);

        }
    }, [token, userPreferences]);

    return (
        <div>
            <header className="mb-4">
                <MDBContainer>
                    <MDBRow>
                        <MDBCol>
                            <h1>News Aggregator</h1>
                            <MDBContainer>
                                <MDBRow>
                                    {searchBarComponent}
                                    <Filters
                                        author={ {
                                            options: authors,
                                            value:authorFilter,
                                            onChange: handleAuthorFilterChange
                                        }}
                                        category={{
                                            options: categories,
                                            value:categoryFilter,
                                            onChange: handleCategoryFilterChange
                                        }}
                                        publishedDate={{
                                            value:publishedDate,
                                            onChange: handlePublishedDateChange
                                        }}
                                        handleFilter={handleFilter}
                                    />

                                </MDBRow>
                            </MDBContainer>
                        </MDBCol>
                    </MDBRow>
                </MDBContainer>
            </header>
            <Container>
                {news.data && (<NewsCard news={news}/>)}
            </Container>
        </div>
    );
};

export default NewsAggregator;
