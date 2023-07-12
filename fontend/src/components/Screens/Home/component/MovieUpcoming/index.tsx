import React from 'react'
import { Row, Col, Typography, Empty } from 'antd'
const { Title } = Typography
import MovieItem from '@/components/Elements/MovieItem'
import style from './style.module.less'
import { TMovies } from '@/modules/movies'
interface movies {
      fetchAllMovies: TMovies[];
}
function MovieUpcoming({ fetchAllMovies }: movies) {
      return (
            <div className='container'>
                  <Row className={style.movieUpcoming}>
                        <Col span={24}>
                              <Title level={3}>PHIM SẮP CHIẾU</Title>
                        </Col>
                        <Col span={24}>
                              {
                                    fetchAllMovies.length> 0 ? (<Row gutter={[{ xs: 0, sm: 20, md: 20, lg: 35, xl: 50 }, 50]}>
                                          {fetchAllMovies && fetchAllMovies?.map((item) => (<MovieItem movies={item} />))}
                                    </Row>) : (<div style={{textAlign: 'center', color: 'white'}}><Empty /> <p>Update late...</p></div>)
                              }
                        </Col>
                  </Row>
            </div>
      )
}

export default MovieUpcoming