import {MDBCol, MDBInput} from "mdb-react-ui-kit";
import React from "react";

const PublishedDateFilter = (props) => {
    const {options, value, onChange} =  props;

    return (
        <>
            <MDBCol md="3">
                <label htmlFor="publishedDate" className="form-label">Published Date:</label>
                <MDBInput
                    type="date"
                    id="publishedDate"
                    value={value}
                    onChange={onChange}
                />
            </MDBCol>
        </>
    );
}
export default PublishedDateFilter;


