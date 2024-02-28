import 'dart:convert';

class User {
  final String id;
  final String? name;
  final String phone;
  final String nid;
  final String tin;
  User({
    required this.id,
    this.name,
    required this.phone,
    required this.nid,
    required this.tin,
  });

  User copyWith({
    String? id,
    String? name,
    String? phone,
    String? nid,
    String? tin,
  }) {
    return User(
      id: id ?? this.id,
      name: name ?? this.name,
      phone: phone ?? this.phone,
      nid: nid ?? this.nid,
      tin: tin ?? this.tin,
    );
  }

  Map<String, dynamic> toMap() {
    return <String, dynamic>{
      '_id': id,
      'name': name,
      'phone': phone,
      'nid': nid,
      'tin': tin,
    };
  }

  factory User.fromMap(Map<String, dynamic> map) {
    return User(
      id: map['_id'] as String,
      name: map['name'] != null ? map['name'] as String : null,
      phone: map['phone'] as String,
      nid: map['nid'] as String,
      tin: map['tin'] as String,
    );
  }

  String toJson() => json.encode(toMap());

  factory User.fromJson(String source) =>
      User.fromMap(json.decode(source) as Map<String, dynamic>);

  @override
  String toString() {
    return 'User(id: $id, name: $name, phone: $phone, nid: $nid, tin: $tin)';
  }

  @override
  bool operator ==(covariant User other) {
    if (identical(this, other)) return true;

    return other.id == id &&
        other.name == name &&
        other.phone == phone &&
        other.nid == nid &&
        other.tin == tin;
  }

  @override
  int get hashCode {
    return id.hashCode ^
        name.hashCode ^
        phone.hashCode ^
        nid.hashCode ^
        tin.hashCode;
  }
}
