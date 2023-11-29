import axios from 'axios';
import {useEffect, useState} from 'react';
import useFilters from "./useFilters";
import SearchBar from "../components/SearchBar/searchBar";
const useNewsAggregator = (props) => {
    const {token, http, userPreferences} = props;
    const [news, setNews] = useState([]);
    const [searchQuery, setSearchQuery] = useState('');

    const {
        publishedDate
    } =  useFilters({
        token, http, setNews
    })



    const fetchData = async () => {
        try {
            // Fetch news based on user preferences or selected options
            const userPreferencesData = token ? (userPreferences || {}) : {};
            const response = await axios.get(`${process.env.REACT_APP_API_BASEURL}/news/all`, {
                params: {
                    author: userPreferencesData.preferred_authors && userPreferencesData.preferred_authors.map((author) => author.name).join(','),
                    category: userPreferencesData.preferred_categories && userPreferencesData.preferred_categories.map((category) => category.name).join(','),
                    source: userPreferencesData.preferred_sources && userPreferencesData.preferred_sources.map((source) => source.name).join(','),
                    q: searchQuery,
                    published_date: publishedDate
                },
            });

            setNews(response.data);
        } catch (error) {
            console.error('Error fetching news:', error);
        }
    };

    useEffect(() => {
        fetchData(); // Initial fetch without debouncing
    }, [token, fetchData]);

    const fetchNews = async (params) => {
        try {
            const response = await http.get(`/news/all`, {
                params,
            });
            setNews(response.data);
        } catch (error) {
            console.error('Error fetching news:', error);
        }
    };


    const fetchNewsWithPreferences = async () => {
        try {
            const response = await http.get(`/news/all`,
                {
                    params: {
                        author: userPreferences.preferred_authors.map((author) => author.name).join(',') ?? '',
                        category: userPreferences.preferred_categories.map((category) => category.name).join(',') ?? '',
                        source: userPreferences.preferred_sources.map((source) => source.name).join(',') ?? '',
                        q: searchQuery,
                        published_date: publishedDate
                    },
                }
            );
            setNews(response.data);
        } catch (error) {
            console.error('Error fetching news:', error);
        }
    };

    const searchBarComponent =  (<SearchBar  fetchData={fetchData} searchQuery={searchQuery} setSearchQuery={setSearchQuery } />);
    return {
        news, setNews, fetchNews, fetchNewsWithPreferences,fetchData, searchBarComponent
    }
}

export default useNewsAggregator;