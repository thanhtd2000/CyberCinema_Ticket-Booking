import { Spin } from 'antd'
import React from 'react'
import style from './style.module.less'
function Loading() {
  return (
    <div className={style.Loading}>
      <Spin />
    </div>
  )
}

export default Loading