import { useState } from 'react'
import { useQuery } from 'react-query'
import axios from 'axios'

import './style/AppStyle.scss'

import { Table } from './components/Table'
import { Links } from './components/Links'
import { Form } from './components/Form'

const App = () => {
    const [page, setPage] = useState(0)
    const [size, setSize] = useState(10)

    const onHandleClick = (newPage: number) => setPage(newPage)
    const onHandleDelete = () => tableQuery.refetch()
    const onHandleAdd = () => tableQuery.refetch()

    const tableQuery = useQuery({
        queryKey: ['table', page, size], 
        queryFn: async () => {
            const response = await axios.get('http://localhost:8080/employees', {
                params: {
                    page: page,
                    size: size,
                    sort: ''
                },
            })
            return response.data
        }
    })

    return (
        <div className="App">
            {(tableQuery.isLoading? <>loading...</> :
            tableQuery.data?.page.number != page? <>loading...</> :
            <div className="app-content">
                <Form handleAdd={onHandleAdd} />
                <Table employees={tableQuery.data._embedded.employees} handleDelete={onHandleDelete} />
                <Links page={tableQuery.data.page} handleClick={onHandleClick}/>
            </div>)}
        </div>
    )
}

export default App
