export default {
  // Endpoints
  loginEndpoint: '/auth/login',
  registerEndpoint: '/auth/register',
  // refreshEndpoint: '/api/refresh-token',
  logoutEndpoint: '/auth/logout',
  authUserEndpoint: '/user',

  // This will be prefixed in authorization header with token
  // e.g. Authorization: Bearer <token>
  tokenType: 'Bearer',

  // Value of this property will be used as key to store JWT token in storage
  storageTokenKeyName: 'accessToken',
  storageRefreshTokenKeyName: 'refreshToken',
}
