import 'dart:convert';

class Entity {
  int id;
  String name;
  String bin;
  String adress;
  Entity({
    required this.id,
    required this.name,
    required this.bin,
    required this.adress,
  });

  Entity copyWith({
    int? id,
    String? name,
    String? bin,
    String? adress,
  }) {
    return Entity(
      id: id ?? this.id,
      name: name ?? this.name,
      bin: bin ?? this.bin,
      adress: adress ?? this.adress,
    );
  }

  Map<String, dynamic> toMap() {
    final result = <String, dynamic>{};

    result.addAll({'id': id});
    result.addAll({'name': name});
    result.addAll({'bin': bin});
    result.addAll({'adress': adress});

    return result;
  }

  factory Entity.fromMap(Map<String, dynamic> map) {
    return Entity(
      id: map['id']?.toInt() ?? 0,
      name: map['name'] ?? '',
      bin: map['bin'] ?? '',
      adress: map['adress'] ?? '',
    );
  }

  String toJson() => json.encode(toMap());

  factory Entity.fromJson(String source) => Entity.fromMap(json.decode(source));

  @override
  String toString() {
    return 'Entity(id: $id, name: $name, bin: $bin, adress: $adress)';
  }

  @override
  bool operator ==(Object other) {
    if (identical(this, other)) return true;

    return other is Entity &&
        other.id == id &&
        other.name == name &&
        other.bin == bin &&
        other.adress == adress;
  }

  @override
  int get hashCode {
    return id.hashCode ^ name.hashCode ^ bin.hashCode ^ adress.hashCode;
  }
}
