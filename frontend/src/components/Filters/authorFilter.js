import {MDBCol} from "mdb-react-ui-kit";
import Select from "react-select";
import React from "react";

const AuthorFilter = (props) => {
    const {options, value, onChange} =  props;

    return (
        <>

            <MDBCol md="3">
                <label htmlFor="authorFilter" className="form-label">Author:</label>
                <Select
                    id="authorFilter"
                    isMulti
                    options={options.map(author => {
                        return {
                            label: author.name,
                            value: author.name
                        }
                    })}
                    placeholder="Select authors"
                    value={value}
                    onChange={onChange}
                />
            </MDBCol>


        </>
    );
}
export default AuthorFilter;
