import 'package:hooks_riverpod/hooks_riverpod.dart';
import 'package:itr/core/models/user.dart';
import 'package:itr/core/services/local_storage.dart';
import 'package:itr/core/utils/api_client.dart';
import 'package:itr/core/utils/constants.dart';

enum AuthStatus { registered, verified, invalid }

class AuthController {
  final Reader _reader;

  AuthController(this._reader);

  User? currentUser;

  Future<bool> sendOTP(String phoneNumber) async {
    try {
      final response = await _reader(apiClientProvider).post(
        AppConstants.sendOtp,
        data: {'phone': phoneNumber},
      );
      return response.statusCode == 200;
    } catch (e) {
      return false;
    }
  }

  Future<AuthStatus> verifyOTP(String phone, String otp) async {
    try {
      final response = await _reader(apiClientProvider).post(
        AppConstants.verifyOtp,
        data: {'phone': phone, 'otp': otp},
      );
      if (response.statusCode == 200) {
        if (response.data['data'] != null &&
            response.headers.value('access-token') != null) {
          currentUser = User.fromMap(response.data['data']);
          final token = response.headers.value('access-token')!;
          _reader(apiClientProvider).updateToken(token);
          _reader(localStorageProvider).saveToken(token);
          _reader(localStorageProvider).saveUser(currentUser!);
          return AuthStatus.registered;
        }
        return AuthStatus.verified;
      }
      return AuthStatus.invalid;
    } catch (e) {
      return AuthStatus.invalid;
    }
  }

  Future<bool> register(String phoneNumber, String nid, String tin) async {
    try {
      final response = await _reader(apiClientProvider).post(
        AppConstants.register,
        data: {'phone': phoneNumber, 'nid': nid, 'tin': tin},
      );
      if (response.statusCode == 201) {
        currentUser = User.fromMap(response.data['data']);
        final token = response.headers.value('access-token')!;
        _reader(apiClientProvider).updateToken(token);
        _reader(localStorageProvider).saveToken(token);
        _reader(localStorageProvider).saveUser(currentUser!);
        return true;
      }
      return false;
    } catch (e) {
      return false;
    }
  }

  Future<void> logout() async {
    currentUser = null;
    _reader(apiClientProvider).updateToken(null);
    await _reader(localStorageProvider).removeTokenAndUser();
  }
}

final authControllerProvider = Provider((ref) => AuthController(ref.read));
