// To parse this JSON data, do
//
//     final getFiles = getFilesFromJson(jsonString);

import 'dart:convert';

import 'package:user/model/entity.dart';

GetFiles getFilesFromJson(String str) => GetFiles.fromJson(json.decode(str));

String getFilesToJson(GetFiles data) => json.encode(data.toJson());

class GetFiles {
  GetFiles({
    required this.documents,
  });

  List<Document> documents;

  factory GetFiles.fromJson(Map<String, dynamic> json) => GetFiles(
        documents: List<Document>.from(
            json["documents"].map((x) => Document.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "documents": List<dynamic>.from(documents.map((x) => x.toJson())),
      };
}

class Document {
  Document({
    required this.id,
    required this.name,
    required this.fileAsImage,
    required this.fileExtension,
    required this.user,
    required this.transaction,
    required this.entity,
    required this.documentTypeId,
    required this.status,
    required this.createdAt,
  });

  int id;
  String name;
  String fileAsImage;
  String fileExtension;
  User user;
  dynamic transaction;
  Entity entity;
  dynamic documentTypeId;
  String status;
  DateTime createdAt;

  factory Document.fromJson(Map<String, dynamic> json) => Document(
        id: json["id"],
        name: json["name"],
        fileAsImage: json["file_as_image"],
        fileExtension: json["file_extension"],
        user: User.fromJson(json["user"]),
        transaction: json["transaction"],
        entity: Entity.fromMap(json["entity"]),
        documentTypeId: json["document_type_id"],
        status: json["status"],
        createdAt: DateTime.parse(json["created_at"]),
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "name": name,
        "file_as_image": fileAsImage,
        "file_extension": fileExtension,
        "user": user.toJson(),
        "transaction": transaction,
        "entity": entity.toJson(),
        "document_type_id": documentTypeId,
        "status": status,
        "created_at": createdAt.toIso8601String(),
      };
}

class User {
  User({
    required this.id,
    required this.name,
    required this.email,
    required this.emailVerifiedAt,
    required this.phone,
    required this.address,
    required this.type,
    required this.status,
    required this.createdAt,
    required this.updatedAt,
    required this.avatar,
  });

  int id;
  String name;
  String email;
  dynamic emailVerifiedAt;
  String phone;
  dynamic address;
  String type;
  String status;
  DateTime createdAt;
  DateTime updatedAt;
  String avatar;

  factory User.fromJson(Map<String, dynamic> json) => User(
        id: json["id"],
        name: json["name"],
        email: json["email"],
        emailVerifiedAt: json["email_verified_at"],
        phone: json["phone"],
        address: json["address"],
        type: json["type"],
        status: json["status"],
        createdAt: DateTime.parse(json["created_at"]),
        updatedAt: DateTime.parse(json["updated_at"]),
        avatar: json["avatar"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "name": name,
        "email": email,
        "email_verified_at": emailVerifiedAt,
        "phone": phone,
        "address": address,
        "type": type,
        "status": status,
        "created_at": createdAt.toIso8601String(),
        "updated_at": updatedAt.toIso8601String(),
        "avatar": avatar,
      };
}
