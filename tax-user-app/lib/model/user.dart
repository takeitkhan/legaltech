import 'dart:convert';

class User {
  int id;
  String name;
  String email;
  String phone;
  String address;
  String type;
  String status;
  String avatar;
  User({
    required this.id,
    required this.name,
    required this.email,
    required this.phone,
    required this.address,
    required this.type,
    required this.status,
    required this.avatar,
  });

  User copyWith({
    int? id,
    String? name,
    String? email,
    String? phone,
    String? address,
    String? type,
    String? status,
    String? avatar,
  }) {
    return User(
      id: id ?? this.id,
      name: name ?? this.name,
      email: email ?? this.email,
      phone: phone ?? this.phone,
      address: address ?? this.address,
      type: type ?? this.type,
      status: status ?? this.status,
      avatar: avatar ?? this.avatar,
    );
  }

  Map<String, dynamic> toMap() {
    final result = <String, dynamic>{};

    result.addAll({'id': id});
    result.addAll({'name': name});
    result.addAll({'email': email});
    result.addAll({'phone': phone});
    result.addAll({'address': address});
    result.addAll({'type': type});
    result.addAll({'status': status});
    result.addAll({'avatar': avatar});

    return result;
  }

  factory User.fromMap(Map<String, dynamic> map) {
    return User(
      id: map['id']?.toInt() ?? 0,
      name: map['name'] ?? '',
      email: map['email'] ?? '',
      phone: map['phone'] ?? '',
      address: map['address'] ?? '',
      type: map['type'] ?? '',
      status: map['status'] ?? '',
      avatar: map['avatar'] ?? '',
    );
  }

  String toJson() => json.encode(toMap());

  factory User.fromJson(String source) => User.fromMap(json.decode(source));

  @override
  String toString() {
    return 'User(id: $id, name: $name, email: $email, phone: $phone, address: $address, type: $type, status: $status, avatar: $avatar)';
  }

  @override
  bool operator ==(Object other) {
    if (identical(this, other)) return true;

    return other is User &&
        other.id == id &&
        other.name == name &&
        other.email == email &&
        other.phone == phone &&
        other.address == address &&
        other.type == type &&
        other.status == status &&
        other.avatar == avatar;
  }

  @override
  int get hashCode {
    return id.hashCode ^
        name.hashCode ^
        email.hashCode ^
        phone.hashCode ^
        address.hashCode ^
        type.hashCode ^
        status.hashCode ^
        avatar.hashCode;
  }
}
