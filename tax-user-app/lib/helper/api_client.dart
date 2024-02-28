import 'dart:async';
import 'dart:convert';
import 'dart:io';

import 'package:flutter/cupertino.dart';
import 'package:flutter/foundation.dart';
import 'package:get/get.dart';
import 'package:http/http.dart' as http;

class ApiClient {
  String? token;
  Map<String, dynamic> defaultHeaders = {
    'Content-Type': 'application/json',
    'Charset': 'utf-8'
  };

  Future<dynamic> get(String url, {Map<String, String>? query}) async {
    final uri = Uri.parse(url).replace(queryParameters: query);
    if (kDebugMode) {
      print('Api:' + uri.toString());
    }

    try {
      if (kDebugMode) {
        print('Bearer $token');
      }
      final response = await http.get(
        uri,
        headers: {
          ...defaultHeaders,
          HttpHeaders.authorizationHeader: 'Bearer $token',
        },
      ).timeout(const Duration(seconds: 20));
      return proscessResponse(response);
    } on SocketException {
      Get.showSnackbar(const GetSnackBar(message: 'No internet connection'));
    } on TimeoutException {
      Get.showSnackbar(const GetSnackBar(message: 'API not responed in time'));
    }
  }

  Future<dynamic> post(
    String url, {
    Object? body,
    Map<String, String>? headers,
  }) async {
    if (kDebugMode) {
      print('API: ' + url);
    }

    try {
      final response = await http
          .post(
            Uri.parse(url),
            body: body,
            headers: headers ??
                {
                  ...defaultHeaders,
                  HttpHeaders.authorizationHeader: 'Bearer $token',
                },
          )
          .timeout(
            const Duration(seconds: 20),
          );
      return proscessResponse(response);
    } on SocketException {
      Get.showSnackbar(const GetSnackBar(title: 'No internet connection'));
    } on TimeoutException {
      Get.showSnackbar(const GetSnackBar(title: 'API not responed in time'));
    }
  }

  // MultipartRequest
  Future<dynamic> multipartRequest(
    String url, {
    required List<http.MultipartFile> files,
    required Map<String, String> body,
    Map<String, String>? headers,
  }) async {
    if (kDebugMode) {
      print('API: ' + url);
    }

    try {
      final request = http.MultipartRequest("POST", Uri.parse(url));
      request.headers.addAll(headers ??
          {
            ...defaultHeaders,
            HttpHeaders.authorizationHeader: 'Bearer $token',
          });
      for (var file in files) {
        request.files.add(file);
        if (kDebugMode) {
          print(files);
        }
      }
      request.fields.addAll(body);
      final streamedReponse = await request.send();
      final response = await http.Response.fromStream(streamedReponse);

      return proscessResponse(response);
    } on SocketException {
      Get.showSnackbar(const GetSnackBar(
          title: 'No internet connection', duration: Duration(seconds: 2)));
    } on TimeoutException {
      Get.showSnackbar(const GetSnackBar(
          title: 'API not responed in time', duration: Duration(seconds: 2)));
    }
  }
}
// proscess response

http.Response proscessResponse(http.Response response) {
  final data = jsonDecode(response.body);
  final statusCode = response.statusCode;
  if (kDebugMode) {
    print("statusCode : $statusCode");
  }
  if (statusCode >= 200 && statusCode <= 300) {
    return response;
  } else if (statusCode == 400) {
    Get.showSnackbar(
      GetSnackBar(
        message: data['message'],
        borderRadius: 5.0,
        margin: const EdgeInsets.all(16).copyWith(bottom: 20),
        backgroundColor:
            const Color.fromARGB(255, 217, 28, 28).withOpacity(0.8),
        duration: const Duration(seconds: 2),
        dismissDirection: DismissDirection.horizontal,
      ),
    );
    return response;
  } else if (statusCode == 401) {
    Get.showSnackbar(
      GetSnackBar(
        message: data['message'],
        borderRadius: 5.0,
        margin: const EdgeInsets.all(16).copyWith(bottom: 20),
        backgroundColor:
            const Color.fromARGB(255, 217, 28, 28).withOpacity(0.8),
        duration: const Duration(seconds: 2),
        dismissDirection: DismissDirection.horizontal,
      ),
    );
    return response;
  } else if (statusCode == 403) {
    Get.showSnackbar(
      GetSnackBar(
        message: data['message'],
        borderRadius: 5.0,
        margin: const EdgeInsets.all(16).copyWith(bottom: 20),
        backgroundColor:
            const Color.fromARGB(255, 217, 28, 28).withOpacity(0.8),
        duration: const Duration(seconds: 2),
        dismissDirection: DismissDirection.horizontal,
      ),
    );
    return response;
  } else {
    Get.showSnackbar(
      GetSnackBar(
        message: 'Something went wrong!',
        borderRadius: 5.0,
        margin: const EdgeInsets.all(16).copyWith(bottom: 20),
        backgroundColor:
            const Color.fromARGB(255, 217, 28, 28).withOpacity(0.8),
        duration: const Duration(seconds: 2),
        dismissDirection: DismissDirection.horizontal,
      ),
    );
    return response;
  }
}
