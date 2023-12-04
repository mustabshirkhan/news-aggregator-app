import {MDBCol, MDBInput} from "mdb-react-ui-kit";
import React from "react";
import _debounce from 'lodash/debounce'; // Import debounce from lodash
const SearchBar = (props) => {
    const {fetchData, searchQuery, setSearchQuery} = props;
    const debouncedFetchData = _debounce(() => {
        fetchData();
    }, 300); // Set the debounce delay (in milliseconds)

    const handleSearchChange = (e) => {
        setSearchQuery(e.target.value);
        debouncedFetchData(); // Use the debounced function
    };
    return (
        <>

            <MDBCol md="12">
                <MDBInput
                    type="text"
                    label="Search for news articles..."
                    value={searchQuery}
                    onChange={handleSearchChange}
                />
            </MDBCol>

        </>
    );
}
export default SearchBar;
