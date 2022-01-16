import React,{useEffect,useState} from 'react';
import ReactDOM from 'react-dom';
import '../../../node_modules/bootstrap/dist/css/bootstrap.css'
import {Table} from 'antd'
import '../../../node_modules/antd/dist/antd.css'

function Example() {
     const [dataContact,setDataContact] = useState([]);
  
    const { Column, ColumnGroup } = Table;


    useEffect(() => {

        axios
        .get('http://127.0.0.1:8000/api/contact')
        .then(function(response){
            const data = response.data
            console.log(data)
            setDataContact(data)
        })
        .catch(function(error){
            console.log(error);
        })
        .then(function(){
            
        })
    }, [])
    return (
        <div className="container">
            <div className="row">
                <div className="col-lg-6">
                </div>
                    <div className="col-lg-6">
                    <h1>Table Contact</h1>
                    <Table dataSource={dataContact} >
                    <Column title="Name" dataIndex="name" key="age" />
                    <Column title="Phone" dataIndex="phone" key="phone" />
                    <Column 
                        title="Action" 
                        dataIndex="action"
                        key="id" 
                        render={(text,record)=>(
                            <>
                            {console.log(record.id)}
                                <Button type="primary" primary>
                                Edit
                                </Button>
                                <Button type="primary" danger >
                                Danger
                                </Button>
                            </>
                            )}
                        />
                    </Table>
                </div>
            </div>
        </div>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
