import React from 'react'
import {Row, Col, Buttom, Typography} from 'antd'
const {Title, Paragraph} = Typography
import MovieItem from '@/components/Elements/MovieItem'
import style from './style.module.less'
function MovieUpcoming() {
  return (
    <div className='container'>
      <Row className={style.movieUpcoming}>
            <Col span={24}>
                  <Title level={3}>Phim sắp chiếu</Title>
            </Col>
            <Col span={24}>
                  <Row gutter={[{xs: 0 ,sm: 20,md: 20 ,lg:35,xl: 50}, 50]}>
                        <MovieItem></MovieItem>
                        <MovieItem></MovieItem>
                        <MovieItem></MovieItem>
                        <MovieItem></MovieItem>
                        <MovieItem></MovieItem>
                        <MovieItem></MovieItem>
                        <MovieItem></MovieItem>
                        <MovieItem></MovieItem>
                  </Row>
            </Col>
      </Row>
    </div>
  )
}

export default MovieUpcoming