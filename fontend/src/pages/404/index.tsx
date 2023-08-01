import React from 'react'
import style from './style.module.less'
import { Button, Col, Row } from 'antd'
import Image from 'next/image'
function NotFound() {
  return (
    <div>
      <Row className={style.notFound}>
            <Col span={24}>
                  <Image src='/images/404.png' style={{width: '50%'}} alt='404' width={1000} height={500}/>
            </Col>
            <Col span={24}>
                  <p>PAGE NOT FOUND</p>
                  <Button href='/'>Quay về trang chủ</Button>
            </Col>
      </Row>
    </div>
  )
}

export default NotFound