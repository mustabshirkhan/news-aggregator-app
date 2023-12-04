import React, {useState, useEffect} from 'react';
import {
    MDBRow,
    MDBCol,
    MDBCard,
    MDBCardBody,
    MDBBtn,
    MDBContainer,
} from 'mdb-react-ui-kit';
import useAuth from '../../hooks/useAuth';
import usePreference from '../../hooks/usePreferences';
import Select from "react-select";

const  Preferences = () => {
    const {http, token} = useAuth();
    const hookProps =  usePreference({http, token});
    const [authorPreference, setAuthorPreference] = useState([]);
    const [categoryPreference, setCategoryPreference] = useState([]);
    const [sourcePreference, setSourcePreference] = useState([]);

    const {
        sources,
        categories,
        authors,
        handleSave,
        userPreferences,
        successMsg
    } =  hookProps;
    useEffect(() => {
        if (token && userPreferences) {
            // Set initial state based on user preferences
            setAuthorPreference(
                userPreferences?.preferred_authors?.map((author) => ({
                    label: author.name,
                    value: author.name,
                })) || []);
            setCategoryPreference(
                userPreferences?.preferred_categories?.map((category) => ({
                    label: category.name,
                    value: category.name,
                })) || []);
            setSourcePreference(
                userPreferences?.preferred_sources?.map((source) => ({
                    label: source.name,
                    value: source.name,
                })) || []);

            // Other filters...
        }
    }, [token, userPreferences]);

    const handleAuthorChange = (value) => {
        setAuthorPreference(value);
    };

    const handleCategoryChange = (value) => {
        setCategoryPreference(value);
    };

    const handleSourceChange = (value) => {
        setSourcePreference(value);
    };

    function renderElement(){
        return (
            <MDBCard>
                <MDBCardBody>

                    <MDBRow>
                        <MDBCol>
                            <MDBContainer>
                                <MDBRow>
                                    <MDBCol md="12">
                                        <label htmlFor="authorFilter" className="form-label">Author:</label>
                                        <Select
                                            id="authorPreference"
                                            isMulti
                                            options={authors.map(author => {
                                                return {
                                                    label: author.name,
                                                    value: author.name
                                                }
                                            })}
                                            placeholder="Select authors"
                                            value={authorPreference}
                                            onChange={handleAuthorChange}
                                        />
                                    </MDBCol>

                                    <MDBCol md="12">
                                        <label htmlFor="categoryPreferences" className="form-label">Category:</label>
                                        <Select
                                            id="categoryPreferences"
                                            isMulti
                                            options={categories.map(category => {
                                                return {
                                                    label: category.name,
                                                    value: category.name
                                                }
                                            })}
                                            placeholder="Select categories"
                                            value={categoryPreference}
                                            onChange={handleCategoryChange}
                                        />
                                    </MDBCol>
                                    <MDBCol md="12">
                                        <label htmlFor="sourcePreference" className="form-label">Sources:</label>
                                        <Select
                                            id="sourcePreference"
                                            isMulti
                                            options={sources.map(author => {
                                                return {
                                                    label: author.name,
                                                    value: author.name
                                                }
                                            })}
                                            placeholder="Select Sources"
                                            value={sourcePreference}
                                            onChange={handleSourceChange}
                                        />
                                    </MDBCol>

                                </MDBRow>
                            </MDBContainer>
                        </MDBCol>
                    </MDBRow>

                    <MDBRow className="mt-3">
                        {successMsg && (
                            <MDBRow className="mt-3">
                                <div className="text-success">{successMsg}</div>
                            </MDBRow>
                        )}
                        <div className="d-grid gap-2 d-md-flex justify-content-md-end">
                            <MDBBtn onClick={()=>handleSave(authorPreference,categoryPreference,sourcePreference)}>Save</MDBBtn>
                        </div>
                    </MDBRow>
                </MDBCardBody>
            </MDBCard>
        );
    }

    return(
        <div>
            <h1 className='mb-4 mt-4'>Preferences</h1>
            { renderElement() }
        </div>
    )
}


export default Preferences;