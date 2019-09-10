import request from '@/utils/request'

export function permissionList(data) {
  return request({
    url: 'api/permission',
    method: 'get',
    data
  })
}

export function getPermission(id) {
    return request({
        url: `api/permission/${id}`,
        method: 'get',
    })
}

export function permissionCreate(data) {
    return request({
        url: 'api/permission',
        method: 'post',
        data
    })
}

export function permissionUpdate(id,data) {
    return request({
        url: `api/permission/${id}`,
        method: 'put',
        data
    })
}

export function permissionDelete(id) {
    return request({
        url: `api/permission/${id}`,
        method: 'delete',
    })
}

export function roleList(data) {
    return request({
        url: 'api/role',
        method: 'get',
        data
    })
}

export function getRole(id) {
    return request({
        url: `api/role/${id}`,
        method: 'get',
    })
}

export function roleCreate(data) {
    return request({
        url: 'api/role',
        method: 'post',
        data
    })
}

export function roleUpdate(id,data) {
    return request({
        url: `api/role/${id}`,
        method: 'put',
        data
    })
}

export function roleDelete(id) {
    return request({
        url: `api/role/${id}`,
        method: 'delete',
    })
}
