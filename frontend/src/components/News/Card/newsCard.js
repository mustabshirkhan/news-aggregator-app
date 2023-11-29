import {MDBCardText} from "mdb-react-ui-kit";
import {Card, Col, Row} from "react-bootstrap"; // Import debounce from lodash
const NewsCard = (props) => {
    const {news} =  props;

    return (
        <>
            <Row>
                {news.data && news.data.map((article) => (
                    <Col key={article.id} xs={12} md={6} lg={4}>
                        <Card className="mb-4">
                            <Card.Img variant="top" src={article.image_url}/>
                            <Card.Body>
                                <MDBCardText>
                                    <small className='text-muted'>{`Source: ${article.source}`}</small>
                                </MDBCardText>
                                <Card.Title>{article.title}</Card.Title>
                                <Card.Text>{article.description}</Card.Text>
                                <a href={article.url} className="btn btn-primary" target={`_blank`}>Read More</a>
                            </Card.Body>
                        </Card>
                    </Col>
                ))}
            </Row>

        </>
    );
}
export default NewsCard;
