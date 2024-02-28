class AppConstants {
  static const baseUrl = 'https://itr.taxesmedia.com';
  static const apiUrl = '$baseUrl/api';

  static const authUrl = '$apiUrl/auth';
  static const sendOtp = '$authUrl/send-otp';
  static const verifyOtp = '$authUrl/verify-otp';
  static const register = '$authUrl/register';
}
