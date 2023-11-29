import {useState} from "react";
import axios from "axios";


const useFilters = (props) => {
    const {token, http, setNews} = props;
    const [authorFilter, setAuthorFilter] = useState([]);
    const [categoryFilter, setCategoryFilter] = useState([]);
    const [publishedDate, setpublishedDate] = useState('');


    const handleAuthorFilterChange = (value) => {
        setAuthorFilter(value);
    };

    const handleCategoryFilterChange = (value) => {
        setCategoryFilter(value);
    };

    const handlePublishedDateChange = (e) => {
        setpublishedDate(e.target.value);
    };

    const handleFilterButton = async () => {
        // Access the selected values from the state
        const selectedAuthorValues = authorFilter.map((author) => author.value);
        const selectedCategoryValues = categoryFilter.map((category) => category.value);
        try{
            const response = await http.get(`/news/all`, {
                params: {
                    author: selectedAuthorValues.join(','), // Convert array to comma-separated string
                    category: selectedCategoryValues.join(','), // Convert array to comma-separated string
                    published_date: publishedDate,
                },
            });
            setNews(response.data)
        } catch(error) {
            console.error('Error fetching filtered news:', error);
        }

    };

    return {
        authorFilter,categoryFilter,publishedDate,
        setCategoryFilter,setAuthorFilter,setpublishedDate,
        handleCategoryFilterChange,handlePublishedDateChange,handleAuthorFilterChange,
        handleFilterButton
    }
}

export default useFilters;