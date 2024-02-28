import 'dart:io';

import 'package:dio/dio.dart';
import 'package:hooks_riverpod/hooks_riverpod.dart';

class ApiClient {
  final _dio = Dio()
    ..interceptors.addAll(
      [
        LogInterceptor(
          requestBody: true,
          responseBody: true,
        ),
        // InterceptorsWrapper(
        //   onError: (error, handler) {
        //     if (error.response != null) {
        //       print(error.response!.data['error']['message']);
        //     }
        //     handler.next(error);
        //   },
        // ),
      ],
    );

  Map<String, dynamic> defaultHeaders = {
    HttpHeaders.authorizationHeader: null,
  };

  Future<Response> get(String url, {Map<String, dynamic>? query}) async {
    return _dio.get(
      url,
      queryParameters: query,
      options: Options(
        headers: defaultHeaders,
      ),
    );
  }

  Future<Response> post(String url, {dynamic data}) async {
    return _dio.post(
      url,
      data: data,
      options: Options(
        headers: defaultHeaders,
      ),
    );
  }

  Future<Response> put(String url, {dynamic data}) async {
    return _dio.put(
      url,
      data: data,
      options: Options(
        headers: defaultHeaders,
      ),
    );
  }

  void updateToken(String? token) {
    if (token == null) {
      defaultHeaders[HttpHeaders.authorizationHeader] = null;
    }
    defaultHeaders[HttpHeaders.authorizationHeader] = 'Bearer $token';
  }
}

final apiClientProvider = Provider((ref) => ApiClient());
