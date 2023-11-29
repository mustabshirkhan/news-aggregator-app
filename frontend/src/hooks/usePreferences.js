import React, {useState, useEffect, useCallback} from 'react';

const usePreferences = (props) => {
    const {http, token} = props;
    const [authors, setAuthors] = useState([]);
    const [categories, setCategories] = useState([]);
    const [sources, setSources] = useState([]);
    const [selectedAuthors, setSelectedAuthors] = useState([]);
    const [selectedCategories, setSelectedCategories] = useState([]);
    const [selectedSources, setSelectedSources] = useState([]);
    const [userPreferences, setuserPreferences] = useState([]);
    const [successMsg, setSuccessMsg] = useState(null);

    useEffect(() => {
        // Fetch data from APIs and set the state variables
        fetchAuthors();
        fetchCategories();
        fetchSources();
        if(token) fetchuserPreferences();

    }, []);
    const fetchAuthors = () => {
        // Fetch authors from the API and set the state variable
        http.get('/news/authors')
            .then((response) => {
                setAuthors(
                    response.data.map((value, index) => {
                        return {id: index + 1, name: value}
                    })
                );
            });
    };
    const fetchCategories = () => {
        // Fetch authors from the API and set the state variable
        http.get('/news/categories')
            .then((response) => {
                setCategories(
                    response.data.map((value, index) => {
                        return {id: index + 1, name: value}
                    })
                )
            });
    };
    const fetchSources = () => {
        // Fetch authors from the API and set the state variable
        http.get('/news/sources')
            .then((response) => {
                setSources(
                    response.data.map((value, index) => {
                        return {id: index + 1, name: value}
                    })
                )
            });
    };
    const fetchuserPreferences = useCallback(() => {
        // Fetch authors from the API and set the state variable

        http.get('/preferences')
            .then((response) => {
                setuserPreferences(response.data.preferences)

            });
    });

    const handleSave = useCallback((authorPreference,categoryPreference,sourcePreference) => {
        // Perform save logic with the selected options
        const requestBody = {
            preferred_authors: authorPreference.map((author, index) => ({id: parseInt(index+1), name: author.label})),
            preferred_categories: categoryPreference.map((category, index) => ({
                id: parseInt(index+1),
                name: category.label
            })),
            preferred_sources: sourcePreference.map((source, index) => ({id: parseInt(index+1), name: source.label}))
        };
        http.post('/preferences/assign', requestBody).then((response) => {
            console.log('Response', response)
            setSuccessMsg(response.data.message)
            setTimeout(() => setSuccessMsg(''), 5000);

        })

    });


    return {
        authors,
        categories,
        sources,
        handleSave,
        fetchuserPreferences,
        userPreferences,
        successMsg

    }
}

export default usePreferences;