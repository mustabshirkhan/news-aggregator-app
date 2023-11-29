import {MDBCol} from "mdb-react-ui-kit";
import Select from "react-select";
import React from "react";

const CategoryFilter = (props) => {
    const {options, value, onChange} =  props;

    return (
        <>


            <MDBCol md="3">
                <label htmlFor="categoryFilter" className="form-label">Category:</label>
                <Select
                    id="categoryFilter"
                    isMulti
                    options={options.map(category => {
                        return {
                            label: category.name,
                            value: category.name
                        }
                    })}
                    placeholder="Select categories"
                    value={value}
                    onChange={onChange}
                />
            </MDBCol>
        </>
    );
}
export default CategoryFilter;
