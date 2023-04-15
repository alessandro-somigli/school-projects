import "../style/LinksStyle.scss"

type LinksProps = {
    page: {
        number: number
        totalPages: number
    }
    handleClick: (arg: number) => void
}

const Links = (props: LinksProps): JSX.Element => {

    return (
        <div className="links-container">
            {(props.page.number != 0? 
                <>
                    <span onClick={() => props.handleClick(0)}>0</span> - 
                    <span onClick={() => props.handleClick(props.page.number - 1)}>{props.page.number - 1}</span> - 
                </> : <><span>#</span> - <span>#</span> - </>)}

            <span className="current-page">{props.page.number}</span> - 
            
            {(props.page.number != props.page.totalPages - 1? <>
                <span onClick={() => props.handleClick(props.page.number + 1)}>{props.page.number + 1}</span> -
                <span onClick={() => props.handleClick(props.page.totalPages - 1)}>{props.page.totalPages - 1}</span>
            </> : <> <span>#</span> - <span>#</span></>)}
        </div>
    )
}

export { Links }