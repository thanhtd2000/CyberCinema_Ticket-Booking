import { Button, Col, Row } from 'antd';
import Image from 'next/image';
import React from 'react'
import { MdOutlineDownloadDone } from 'react-icons/md';
import style from './style.module.less'
function PaymentFailed() {
  return (
    <Row className={style.success}>
      <Col span={24} className={style.top}>
            <Image src='/images/Payment Error.gif' width={500} height={300} alt='img'/>
      </Col>
      <Col span={24} className={style.bottom}>
            <Row style={{textAlign: 'center'}}>
                  <Col span={24}>
                        <h1>ERROR !</h1>
                  </Col>
                  <Col span={24} className={style.successPayment}>
                        <span><MdOutlineDownloadDone /></span><p>Thanh toán thất bại</p>
                  </Col>
                  <Col span={24} className={style.thank}>
                        <p>Vui lòng thử lại</p>
                  </Col>
                  <Col span={24} className={style.button}>
                        <Button href='/'>Back to home</Button>
                  </Col>
            </Row>
      </Col>
    </Row>
  )
}

export default PaymentFailed;