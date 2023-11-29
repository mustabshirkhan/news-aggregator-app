import {MDBBtn, MDBCol, MDBInput} from "mdb-react-ui-kit";
import React from "react";
import CategoryFilter from "./categoryFilter";
import AuthorFilter from "./authorFilter";
import PublishedDateFilter from "./publishedDateFilter";
const Filters = (props) => {
    const {author, category, publishedDate, handleFilter} =  props;

    return (
        <>
            <AuthorFilter options={author.options} value={author.value} onChange={author.onChange} />
            <CategoryFilter options={category.options} value={category.value} onChange={category.onChange} />
            <PublishedDateFilter  value={publishedDate.value} onChange={publishedDate.onChange} />
            <MDBCol md="3" className="d-flex align-items-end">
                <MDBBtn color="primary" onClick={handleFilter}>
                    Filter
                </MDBBtn>
            </MDBCol>
        </>
    );
}
export default Filters;
