import 'package:hooks_riverpod/hooks_riverpod.dart';
import 'package:itr/core/controllers/auth.dart';
import 'package:itr/core/models/user.dart';
import 'package:itr/core/utils/api_client.dart';
import 'package:shared_preferences/shared_preferences.dart';

class LocalStorage {
  final Reader _reader;

  LocalStorage(this._reader);

  Future<void> saveUser(User user) async {
    final pref = await SharedPreferences.getInstance();
    await pref.setString('currentUser', user.toJson());
  }

  Future<void> saveToken(String token) async {
    final pref = await SharedPreferences.getInstance();
    await pref.setString('token', token);
  }

  Future<void> removeTokenAndUser() async {
    final pref = await SharedPreferences.getInstance();
    await pref.remove('token');
    await pref.remove('currentUser');
  }

  Future<bool> loadTokenAndUser() async {
    final pref = await SharedPreferences.getInstance();
    final currentUser = pref.getString('currentUser') != null
        ? User.fromJson(pref.getString('currentUser')!)
        : null;
    final token = pref.getString('token');
    if (currentUser == null || token == null) return false;
    _reader(authControllerProvider).currentUser = currentUser;
    _reader(apiClientProvider).updateToken(token);
    return true;
  }
}

final localStorageProvider = Provider((ref) => LocalStorage(ref.read));
